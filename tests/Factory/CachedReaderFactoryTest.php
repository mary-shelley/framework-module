<?php
namespace Corley\FrameworkModule\Factory;

use Doctrine\Common\Cache\FilesystemCache;
use PHPUnit\Framework\TestCase;
use Doctrine\Common\Annotations\CachedReader;
use Acclimate\Container\CompositeContainer;
use Corley\FrameworkModule\FrameworkModule;

class CachedReaderFactoryTest extends TestCase
{
    public function testCreateBaseServiceManager()
    {
        $module = new FrameworkModule(new CompositeContainer(), [
            "cache" => __DIR__,
            "debug" => true,
            "app" => __DIR__,
        ]);

        $container = $module->getContainer();

        $cache = $container->get(CachedReader::class);

        $this->assertInstanceOf(CachedReader::class, $cache);
    }
}


