<?php
namespace Corley\FrameworkModule\Factory;

use PHPUnit\Framework\TestCase;
use Acclimate\Container\CompositeContainer;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Corley\FrameworkModule\FrameworkModule;

class UrlMatcherFactoryTest extends TestCase
{
    public function testCreateBaseServiceManager()
    {
        $module = new FrameworkModule(new CompositeContainer(), [
            "cache" => "/tmp",
            "debug" => true,
            "app" => __DIR__ . "/../_files",
        ]);

        $container = $module->getContainer();

        $cache = $container->get(UrlMatcher::class);

        $this->assertInstanceOf(UrlMatcher::class, $cache);
    }

    public function testCreateBaseServiceManagerWithoutDebug()
    {
        $module = new FrameworkModule(new CompositeContainer(), [
            "cache" => "/tmp",
            "debug" => false,
            "app" => __DIR__ . "/../_files",
        ]);

        $container = $module->getContainer();

        $cache = $container->get(UrlMatcher::class);

        $this->assertInstanceOf(UrlMatcher::class, $cache);
    }
}

