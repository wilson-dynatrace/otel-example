<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use OpenTelemetry\API\Globals;
use OpenTelemetry\API\Instrumentation\Configurator;
use OpenTelemetry\API\Trace\SpanKind;
use OpenTelemetry\Context\Context;
use OpenTelemetry\Context\ContextStorage;
use OpenTelemetry\Contrib\Context\Swoole\SwooleContextStorage;
use OpenTelemetry\Contrib\Otlp\OtlpHttpTransportFactory;
use OpenTelemetry\Contrib\Otlp\SpanExporter;
use OpenTelemetry\SDK\Trace\SpanProcessor\SimpleSpanProcessor;
use OpenTelemetry\SDK\Trace\TracerProvider;
use OpenTelemetry\SDK\Trace\Tracer;
use OpenTelemetry\API\Trace\SpanInterface;
use Swoole\Http\Server;
use Swoole\Http\Request;
use Swoole\Http\Response;

// Setup OpenTelemetry with Swoole context storage
$transport = (new OtlpHttpTransportFactory())->create('http://jaeger:4318/v1/traces', 'application/json');
$exporter = new SpanExporter($transport);
$spanProcessor = new SimpleSpanProcessor($exporter);
$tracerProvider = new TracerProvider($spanProcessor);

// Important: Use Swoole-specific context storage for coroutines
Context::setStorage(new SwooleContextStorage(new ContextStorage()));

// Register the tracer provider
Globals::registerInitializer(fn(Configurator $configurator) => $configurator->withTracerProvider($tracerProvider));

/** @var Tracer $tracer */
$tracer = $tracerProvider->getTracer('swoole-demo');

// Create Swoole HTTP server
$http = new Server('0.0.0.0', 9501);

$http->on('start', function () {
    echo "Swoole HTTP server started at http://localhost:9501\n";
});

$http->on('request', function (Request $request, Response $response) use ($tracer) {
    $path = $request->server['request_uri'] ?? '/';

    // Start root span for the incoming request
    $rootSpan = $tracer->spanBuilder("HTTP {$request->server['request_method']} {$path}")
        ->setSpanKind(SpanKind::KIND_SERVER)
        ->startSpan();

    $scope = $rootSpan->activate();

    try {
        if ($path === '/') {
            $response->header('Content-Type', 'text/plain');
            $response->end("Hello from Swoole!\n");
        } elseif ($path === '/slow') {
            // Simulate slow work with coroutine sleep
            Swoole\Coroutine::sleep(1);
            $response->header('Content-Type', 'text/plain');
            $response->end("Slow endpoint done!\n");
        } else {
            $response->status(404);
            $response->end("Not Found\n");
        }

        // Add events or attributes as needed
        $rootSpan->setAttribute('http.url', $path);
        $rootSpan->setAttribute('http.method', $request->server['request_method']);
    } catch (Throwable $e) {
        $rootSpan->setStatus(\OpenTelemetry\API\Trace\StatusCode::STATUS_ERROR, $e->getMessage());
        throw $e;
    } finally {
        $rootSpan->end();
        $scope->detach();
    }
});

// Start the server
$http->start();
