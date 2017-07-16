<?php
namespace Corley\FrameworkModule\Factory;

use Doctrine\Common\Cache\FilesystemCache;
use PHPUnit\Framework\TestCase;
use Doctrine\Common\Annotations\CachedReader;
use Corley\Middleware\Reader\HookReader;
use Acclimate\Container\CompositeContainer;
use Corley\Middleware\Executor\AnnotExecutor;
use Corley\FrameworkModule\FrameworkModule;

class AnnotExecutorFactoryTest extends TestCase
{
    public function testCreateBaseServiceManager()
    {
        $module = new FrameworkModule(new CompositeContainer(), [
            "cache" => __DIR__,
            "debug" => true,
            "app" => __DIR__,
        ]);

        $container = $module->getContainer();

        $cache = $container->get(AnnotExecutor::class);

        $this->assertInstanceOf(AnnotExecutor::class, $cache);
    }
}




