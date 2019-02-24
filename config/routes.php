<?php

use Slim\App;
use Slim\Container;

$debug = false;
if (defined("DEBUG")) {
    $debug = true;
}

$configuration = [
    'settings' => [
        'debug' => $debug,
        'whoops.editor' => 'sublime',
        'displayErrorDetails' => $debug
    ]
];

$container = new Container($configuration);

$app = new App($container);


// Home
$app->get('/', 'App\Controllers\HomeController:index');
$app->get('', 'App\Controllers\HomeController:index');
$app->get('/hello/{name}', function ($request, $response, $args) {
    return $response->getBody()->write("Hello, " . $args['name']);
});

// Run Slim Routes for App
$app->run();
