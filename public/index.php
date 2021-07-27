<?php

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use SONFin\Application;
use SONFin\Models\CategoryCosts;
use SONFin\Plugins\DbPlugin;
use SONFin\Plugins\RouterPlugin;
use SONFin\Plugins\ViewPlugin;
use SONFin\ServiceContainer;
use Zend\Diactoros\Response\RedirectResponse;

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

$app
    ->get('/category-costs', function () use($app){
        $categoryCosts = new CategoryCosts();
        $categories = $categoryCosts->all();

        $view = $app->service('view.renderer');
        return $view->render('category-costs/list.html.twig',[
            'categories' => $categories
        ]);
    }, 'category-costs.list')
    ->get('/category-costs/new', function () use($app){
        $view = $app->service('view.renderer');
        return $view->render('category-costs/create.html.twig');
    },'category-costs.new')
    ->post('/category-costs/store', function (ServerRequestInterface $request) use ($app){
       $data = $request->getParsedBody();
       CategoryCosts::create($data);
       return $app->route('category-costs.list');
    }, 'category-costs.store')
    ->get('/category-costs/{id}/edit', function (ServerRequestInterface $request) use($app){
        $view = $app->service('view.renderer');
        $id = $request->getAttribute('id');
        $category = CategoryCosts::findOrFail($id);
        return $view->render('category-costs/edit.html.twig',[
            'category' => $category
        ]);
    },'category-costs.edit')
    ->post('/category-costs/{id}/update', function (ServerRequestInterface $request) use($app){
        $id = $request->getAttribute('id');
        $category = CategoryCosts::findOrFail($id);
        $data = $request->getParsedBody();
        $category->fill($data);
        $category->save();
        return $app->route('category-costs.list');
    },'category-costs.update')
    ->get('/category-costs/{id}/show', function (ServerRequestInterface $request) use($app){
        $view = $app->service('view.renderer');
        $id = $request->getAttribute('id');
        $category = CategoryCosts::findOrFail($id);
        return $view->render('category-costs/show.html.twig',[
            'category' => $category
        ]);
    },'category-costs.show')
    ->get('/category-costs/{id}/delete', function (ServerRequestInterface $request) use($app){
        $id = $request->getAttribute('id');
        $category = CategoryCosts::findOrFail($id);
        $category->delete();
        return $app->route('category-costs.list');
},'category-costs.delete');

$app->start();
