<?php
namespace Corley\FrameworkModule\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;

use Interop\Container\ContainerInterface;
use Corley\Middleware\App;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Corley\Middleware\Executor\AnnotExecutor;

class AppFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $app = new App(
            $container->get(UrlMatcher::class),
            $container->get(AnnotExecutor::class)
        );

        return $app;
    }
}



