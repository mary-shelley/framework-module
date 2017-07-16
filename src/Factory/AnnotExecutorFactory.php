<?php
namespace Corley\FrameworkModule\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;

use Corley\Middleware\Reader\HookReader;
use Interop\Container\ContainerInterface;
use Doctrine\Common\Annotations\CachedReader;
use Corley\Middleware\Executor\AnnotExecutor;

class AnnotExecutorFactory implements FactoryInterface
{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new AnnotExecutor(
            $container->get(\Psr\Container\ContainerInterface::class),
            $container->get(HookReader::class)
        );
    }
}


