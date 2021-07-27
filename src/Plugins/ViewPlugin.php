<?php
declare(strict_types=1);

namespace SONFin\Plugins;


use Psr\Container\ContainerInterface;
use SONFin\ServiceContainerInterface;
use SONFin\View\viewRenderer;

class ViewPlugin implements PluginInterface
{
    /** Create loader twig templates */
    public function register(ServiceContainerInterface $container)
    {
        $container->addLazy('twig', function(ContainerInterface $container){
            $loader = new \Twig_Loader_Filesystem(__DIR__. '/../../templates');
            $twig = new \Twig_Environment($loader);

            $generator = $container->get('routing.generator');

            $twig->addFunction(new \Twig_SimpleFunction('route',
                function (string $name, $params = []) use ($generator){
                    return $generator->generate($name,$params);
            }));

            return $twig;
        });

        $container->addLazy('view.renderer', function (ContainerInterface $container){
            $twigEnvirement = $container->get('twig');
            return new viewRenderer($twigEnvirement);
        });
    }
}
