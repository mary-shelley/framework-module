<?php
namespace Corley\FrameworkModule\Test;

use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpFoundation\Response;

class Client
{
    private static $instance;

    private $container;

    public static function getInstance(ContainerInterface $container = null)
    {
        if (!self::$instance) {
            self::$instance = new self($container);
        }

        return self::$instance;
    }

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function request(Request $request)
    {
        $app = $this->container->get("app");
        $app->setErrorHandler(function($rq, $rs, $e) {});
        $this->container->get(RequestContext::class)->fromRequest($request);

        return $app->run($request, new Response());
    }
}
