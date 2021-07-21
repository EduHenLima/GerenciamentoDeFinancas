<?php
declare(strict_types=1);

namespace SONFin\Plugins;


use Aura\Router\RouterContainer;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\RequestInterface;
use SONFin\ServiceContainerInterface;
use Zend\Diactoros\ServerRequestFactory;

class RouterPlugin implements PluginInterface
{

    public function register(ServiceContainerInterface $container)
    {
        $routerContainer = new RouterContainer();

        /** Register routers in application */
        $map = $routerContainer->getMap();

        /** Identificar what router acess */
        $matcher = $routerContainer->getMatcher();

        /** Function to generate link with registration routes */
        $generator = $routerContainer->getGenerator();

        $request = $this->getRequest();

        $container->add('routing', $map);
        $container->add('routing.matcher', $matcher);
        $container->add('routing.generator', $generator);
        $container->add(RequestInterface::class, $request);
        $container->addLazy('route', function (ContainerInterface $container){
            $matcher = $container->get('routing.matcher');
            $request = $container->get(RequestInterface::class);
            return $matcher->match($request);
        });
    }

    protected function getRequest():RequestInterface
    {
        return ServerRequestFactory::fromGlobals(
          $_SERVER,$_GET,$_POST,$_COOKIE,$_FILES
        );
    }
}
