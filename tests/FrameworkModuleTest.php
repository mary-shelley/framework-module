<?php
namespace Corley\FrameworkModule;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\Common\Annotations\AnnotationReader;
use Acclimate\Container\CompositeContainer;

class FrameworkModuleTest extends TestCase
{
    public function testCreateBaseServiceManager()
    {
        $module = new FrameworkModule(new CompositeContainer(), [
            "cache" => __DIR__,
            "debug" => true,
            "app" => __DIR__,
        ]);

        $container = $module->getContainer();

        $this->assertInstanceOf(ContainerInterface::class, $container);
    }

    public function testGetAnnotationReader()
    {
        $module = new FrameworkModule(new CompositeContainer(), [
            "cache" => __DIR__,
            "debug" => true,
            "app" => __DIR__,
        ]);

        $container = $module->getContainer();

        $this->assertInstanceOf(AnnotationReader::class, $container->get(AnnotationReader::class));
    }
}
