<?php

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use SONFin\Application;
use SONFin\Plugins\AuthPlugin;
use SONFin\Plugins\DbPlugin;
use SONFin\Plugins\RouterPlugin;
use SONFin\Plugins\ViewPlugin;
use SONFin\ServiceContainer;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/helpers.php';

$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);

$app->plugin(new RouterPlugin());
$app->plugin(New ViewPlugin());
$app->plugin(new DbPlugin());
$app->plugin(new AuthPlugin());

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

/** Always we create a new controller, needs import the file */
require_once __DIR__ . '/../src/controllers/statements.php';
require_once __DIR__ . '/../src/controllers/category-costs.php';
require_once __DIR__ . '/../src/controllers/bill-receives.php';
require_once __DIR__ . '/../src/controllers/bill-pays.php';
require_once __DIR__ . '/../src/controllers/users.php';
require_once __DIR__ . '/../src/controllers/auth.php';

$app->start();
