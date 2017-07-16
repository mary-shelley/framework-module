<?php
namespace Corley\FrameworkModule\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;

use Doctrine\Common\Cache\FilesystemCache;
use Interop\Container\ContainerInterface;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\CachedReader;

class CachedReaderFactory implements FactoryInterface
{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get("Config");

        return new CachedReader(
            $container->get(AnnotationReader::class),
            $container->get(FilesystemCache::class),
            $config["debug"]
        );
    }
}

