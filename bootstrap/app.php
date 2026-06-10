<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\Throwable $e) {
            echo "<h1>Original Error:</h1>";
            echo "<pre>" . $e->getMessage() . "\n" . $e->getFile() . " on line " . $e->getLine() . "</pre>";
            echo "<pre>" . $e->getTraceAsString() . "</pre>";
            die();
        });
    })->create();

// Vercel serverless environment is read-only except for /tmp.
// We override the storage path if running on Vercel.
if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL']) || getenv('VERCEL')) {
    $storagePath = '/tmp/storage';
    $app->useStoragePath($storagePath);

    // Ensure necessary directories exist
    $directories = [
        "$storagePath/app/public",
        "$storagePath/framework/cache/data",
        "$storagePath/framework/sessions",
        "$storagePath/framework/testing",
        "$storagePath/framework/views",
        "$storagePath/logs",
    ];

    foreach ($directories as $dir) {
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
    }
}

return $app;
