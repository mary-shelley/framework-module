<?php
namespace Corley\FrameworkModule\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;

use Interop\Container\ContainerInterface;

use Doctrine\Common\Annotations\CachedReader;

use Corley\Middleware\Loader\RouteAnnotationClassLoader;

use Symfony\Component\Routing\Loader\AnnotationDirectoryLoader;
use Symfony\Component\Routing\Matcher\Dumper\PhpMatcherDumper;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\RequestContext;

class UrlMatcherFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get("Config");

        $reader = $container->get(CachedReader::class);
        $context = $container->get(RequestContext::class);

        $matcher = null;

        $sourceFolder = $config["app"];
        $routeCacheFile = $config["cache"] . DIRECTORY_SEPARATOR . "bootstrap.routes.cache.php";
        $routeCacheClass = "CachedUrlMatcher";

        if (!$config["debug"]) {
            if (!file_exists($routeCacheFile)) {
                $routeLoader = new RouteAnnotationClassLoader($reader);
                $loader = new AnnotationDirectoryLoader(new FileLocator([$sourceFolder]), $routeLoader);
                $routes = $loader->load($sourceFolder);
                $dumper = new PhpMatcherDumper($routes);
                file_put_contents($routeCacheFile, $dumper->dump(["class" => $routeCacheClass]));
                $matcher = new UrlMatcher($routes, $context);
            } else {
                $routes = include $routeCacheFile;
                $className = $routeCacheClass;
                $matcher = new $className($context);
            }
        } else {
            $routeLoader = new RouteAnnotationClassLoader($reader);
            $loader = new AnnotationDirectoryLoader(new FileLocator([$sourceFolder]), $routeLoader);
            $routes = $loader->load($sourceFolder);
            $matcher = new UrlMatcher($routes, $context);
        }
        return $matcher;
    }
}


