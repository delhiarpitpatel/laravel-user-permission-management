<?php
define('LARAVEL_START', microtime(true));
define('SYSTEM_DIR', __DIR__.'/system');

require SYSTEM_DIR.'/vendor/autoload.php';
$app = require_once SYSTEM_DIR.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle( $request = Illuminate\Http\Request::capture())->send();
$kernel->terminate($request, $response);