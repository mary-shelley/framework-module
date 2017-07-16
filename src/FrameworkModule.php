<?php
namespace Corley\FrameworkModule;

use Corley\Modular\Module\ModuleInterface;
use Zend\ServiceManager\ServiceManager;
use Psr\Container\ContainerInterface;

class FrameworkModule implements ModuleInterface
{
    private $options;
    private $globalContainer;

    public function __construct(ContainerInterface $globalContainer, array $options = [])
    {
        $this->globalContainer = $globalContainer;
        $this->options = array_replace_recursive([
            "app" => __DIR__,
            "cache" => "/tmp",
            "debug" => true,
        ], $options);
    }

    public function getContainer()
    {
        $conf = include __DIR__ . '/../configs/services.php';

        $serviceManager = new ServiceManager();
        $serviceManager->configure($conf["services"]);
        $serviceManager->setService("Config", $this->options);
        $serviceManager->setService(ContainerInterface::class, $this->globalContainer);

        return $serviceManager;
    }
}
