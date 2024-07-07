<?php

use App\Http\Middleware\CheckRoleAdmin;
use App\Http\Middleware\CheckRoleDirektur;
use App\Http\Middleware\CheckRoleKaryawan;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'is_karyawan' => CheckRoleKaryawan::class,
            'is_admin' => CheckRoleAdmin::class,
            'is_direktur' => CheckRoleDirektur::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
