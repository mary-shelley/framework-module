<?php
namespace Corley\FrameworkModule\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;

use Doctrine\Common\Cache\FilesystemCache;
use Interop\Container\ContainerInterface;

class FilesystemCacheFactory implements FactoryInterface
{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get("Config");
        return new FilesystemCache($config["cache"]);
    }
}
