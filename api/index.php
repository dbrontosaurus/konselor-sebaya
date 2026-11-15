<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// 1. Arahkan folder storage ke /tmp
$storagePath = '/tmp/storage';
foreach ([
    $storagePath . '/app/public',
    $storagePath . '/framework/cache/data',
    $storagePath . '/framework/sessions',
    $storagePath . '/framework/testing',
    $storagePath . '/framework/views',
    $storagePath . '/logs',
] as $dir) {
    if (! is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// 2. Arahkan bootstrap cache ke /tmp agar ViewServiceProvider & package dapat dimuat
$bootstrapCache = '/tmp/bootstrap/cache';
if (! is_dir($bootstrapCache)) {
    mkdir($bootstrapCache, 0755, true);
}

putenv("APP_PACKAGES_CACHE={$bootstrapCache}/packages.php");
putenv("APP_SERVICES_CACHE={$bootstrapCache}/services.php");
putenv("APP_CONFIG_CACHE={$bootstrapCache}/config.php");
putenv("APP_ROUTES_CACHE={$bootstrapCache}/routes.php");

$_ENV['APP_PACKAGES_CACHE'] = "{$bootstrapCache}/packages.php";
$_ENV['APP_SERVICES_CACHE'] = "{$bootstrapCache}/services.php";
$_ENV['APP_CONFIG_CACHE'] = "{$bootstrapCache}/config.php";
$_ENV['APP_ROUTES_CACHE'] = "{$bootstrapCache}/routes.php";

require __DIR__ . '/../vendor/autoload.php';

/** @var Application $app */
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->useStoragePath($storagePath);

$app->handleRequest(Request::capture());