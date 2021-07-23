<?php

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use SONFin\Application;
use SONFin\Plugins\DbPlugin;
use SONFin\Plugins\RouterPlugin;
use SONFin\Plugins\ViewPlugin;
use SONFin\ServiceContainer;

require_once __DIR__ . '/../vendor/autoload.php';

$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);

$app->plugin(new RouterPlugin());
$app->plugin(New ViewPlugin());
$app->plugin(new DbPlugin());

/**
 * To generate new route, only create a new params in $app->get
 */
$app->get('/', function (RequestInterface $request) use($app){
    $view = $app->service('view.renderer');
    return $view->render('test.html.twig', ['name' => 'Eduardo']);
});

$app->get('/home/{name}/{id}', function (ServerRequestInterface $request){
    $response = new Zend\Diactoros\Response();
    $response->getBody()->write("response com emmitter do diactoros");
    return $response;
});

$app->get('/category-costs', function () use($app){
    $view = $app->service('view.renderer');
    return $view->render('category-costs/list.html.twig');
});

$app->get('/teste/{name}', function (ServerRequestInterface $request) use($app){
    $view = $app->service('view.renderer');
    return $view->render('test.html.twig', ['name' => $request->getAttribute('name')]);
});

$app->start();
