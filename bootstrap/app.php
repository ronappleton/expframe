<?php

use Illuminate\Container\Container;
use Illuminate\Database\DatabaseServiceProvider;
use Illuminate\Routing\RoutingServiceProvider;
use Illuminate\Events\EventServiceProvider;
use Illuminate\Support\Str;
use Dotenv\Dotenv;

require '../vendor/illuminate/support/helpers.php';
require '../bootstrap/Config.php';

$basePath = Str::finish(dirname(__DIR__) , '/');
$configPath = $basePath . 'config/';

Dotenv::createImmutable($basePath)->load();

$app = new Container();
$app->bind('app', $app);
$app->bind('path.base', $basePath);
$app->bind('config', new Config());

Illuminate\Support\Facades\Facade::setFacadeApplication($app);

$app->bind('env', getenv('APP_ENVIRONMENT', 'production'));

require $basePath . 'database/bootstrap.php';

with(new EventServiceProvider($app))->register();
with(new RoutingServiceProvider($app))->register();
with(new DatabaseServiceProvider($app))->register();
