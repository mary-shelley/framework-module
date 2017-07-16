<?php
namespace Corley\FrameworkModule\Factory;

use Doctrine\Common\Cache\FilesystemCache;
use PHPUnit\Framework\TestCase;
use Acclimate\Container\CompositeContainer;
use Corley\FrameworkModule\FrameworkModule;

class FilesystemCacheFactoryTest extends TestCase
{
    public function testCreateBaseServiceManager()
    {
        $module = new FrameworkModule(new CompositeContainer(), [
            "cache" => __DIR__,
            "debug" => true,
            "app" => __DIR__,
        ]);

        $container = $module->getContainer();

        $cache = $container->get(FilesystemCache::class);

        $this->assertInstanceOf(FilesystemCache::class, $cache);
    }
}

