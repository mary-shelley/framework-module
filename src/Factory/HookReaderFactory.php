<?php
namespace Corley\FrameworkModule\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;

use Corley\Middleware\Reader\HookReader;
use Interop\Container\ContainerInterface;
use Doctrine\Common\Annotations\CachedReader;

class HookReaderFactory implements FactoryInterface
{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new HookReader(
            $container->get(CachedReader::class)
        );
    }
}

