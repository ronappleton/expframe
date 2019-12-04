<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;

$capsule = new Capsule();

$capsule->addConnection(config()->get('database.connections.' . config()->get('database.default')));

foreach (config('database.connections') as $name => $connection) {
    $capsule->addConnection($connection, $name);
}

$capsule->bootEloquent();

$capsule->setEventDispatcher(new Dispatcher(app()));

$capsule->setAsGlobal();
