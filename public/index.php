<?php

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use SONFin\Application;
use SONFin\Plugins\RouterPlugin;
use SONFin\ServiceContainer;

require_once __DIR__ . '/../vendor/autoload.php';

$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);

$app->plugin(new RouterPlugin());

/**
 * To generate new route, only create a new params in $app->get
 */
$app->get('/', function (RequestInterface $request){
    $uri = $request->getUri();
    var_dump($uri);

    echo "Hello Wolrd!!!";
});

$app->get('/home/{name}/{id}', function (ServerRequestInterface $request){
    $response = new Zend\Diactoros\Response();
    $response->getBody()->write("response com emmitter do diactoros");
    return $response;
});

$app->start();
