<?php

namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class WeatherControllerTest extends TestCase
{

    public function setUp()
    {
        global $di;

        $di = new DIFactoryConfig();
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $di->loadServices(ANAX_INSTALL_PATH . "/test/config/di");

        $this->di = $di;

        $this->controller = new WeatherController();
        $this->controller->setDI($this->di);
        $this->controller->initialize();
    }



    /**
     * Test the route "index".
     */
    public function testIndexAction()
    {
        $res = $this->controller->indexAction();
        $body = $res->getBody();
        $this->assertContains("Weather Checker", $body);
    }



    public function testindexActionPostFalse()
    {
        $request = $this->di->get("request");
        $request->setPost("ip", "");
        $res = $this->controller->indexActionPost();
        $body = $res->getBody();
        $this->assertContains("Ingen hittad plats", $body);
    }



    public function testindexActionPostTrue()
    {
        $request = $this->di->get("request");
        $request->setPost("ip", "8.8.8.8");
        $request->setPost("days", "week");
        $res = $this->controller->indexActionPost();
        $body = $res->getBody();
        $this->assertContains("Högsta temp:", $body);
    }
}
