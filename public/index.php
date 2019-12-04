<?php

require '../vendor/autoload.php';

require '../bootstrap/app.php';

require $basePath . 'routes.php';

$request = Illuminate\Http\Request::createFromGlobals();

$response = $app['router']->dispatch($request);

$response->send();
