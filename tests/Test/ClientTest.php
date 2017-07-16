<?php
namespace Corley\FrameworkModule\Test;

use PHPUnit\Framework\TestCase;
use Acclimate\Container\CompositeContainer;
use Corley\Middleware\App;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Prophecy\Argument;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;

class ClientTest extends TestCase
{
    public function testBaseClient()
    {
        $response = new Response();

        $app = $this->prophesize(App::class);
        $app->run(Argument::Any(), Argument::Any())->willReturn($response);;
        $app->setErrorHandler(Argument::Any())->willReturn(true);

        $container = $this->prophesize(ContainerInterface::class);
        $container->get("app")->willReturn($app->reveal());
        $container->get(RequestContext::class)->willReturn(new RequestContext());

        $client = Client::getInstance($container->reveal());
        $result = $client->request(Request::create("/"), $response);

        $this->assertSame($result, $response);
    }
}



