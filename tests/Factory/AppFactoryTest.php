<?php
namespace Corley\FrameworkModule\Factory;

use PHPUnit\Framework\TestCase;
use Acclimate\Container\CompositeContainer;
use Corley\Middleware\App;
use Corley\FrameworkModule\FrameworkModule;

class AppFactoryTest extends TestCase
{
    public function testCreateBaseServiceManager()
    {
        $module = new FrameworkModule(new CompositeContainer(), [
            "cache" => "/tmp",
            "debug" => true,
            "app" => __DIR__ . "/../_files",
        ]);

        $container = $module->getContainer();

        $cache = $container->get(App::class);

        $this->assertInstanceOf(App::class, $cache);
    }
}


