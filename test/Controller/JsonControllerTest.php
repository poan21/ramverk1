<?php

namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class JsonControllerTest extends TestCase
{

    public function setUp()
    {
        global $di;

        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        $di = $this->di;

        $this->controller = new JsonController();
        $this->controller->setDI($this->di);
        $this->controller->initialize();
    }

    public function testindexActionGet()
    {

        $ip = "8.8.8.8";
        $valid = "True";
        $host = "dns.google";

        $_GET["ip"] = $ip;
        $res = $this->controller->indexActionGet();

        $json = [[
            "ip" => $ip,
            "valid" => "True",
            "host" => $host,
        ]];

        $this->assertEquals($json, $res);
    }

    public function testindexActionGetFalse()
    {

        $ip = "8.8.8.8.8";
        $valid = "True";
        $host = "dns.google";

        $_GET["ip"] = $ip;
        $res = $this->controller->indexActionGet();

        $json = [[
            "ip" => $ip,
            "valid" => "False",
            "host" => "None found",
        ]];

        $this->assertEquals($json, $res);
    }

    public function testindexActionPost()
    {

        $ip = "8.8.8.8";
        $valid = "True";
        $host = "dns.google";

        $_POST["ip"] = $ip;
        $res = $this->controller->indexActionPost();

        $json = [[
            "ip" => $ip,
            "valid" => "True",
            "host" => $host,
        ]];

        $this->assertEquals($json, $res);
    }



    public function testindexActionPostFalse()
    {

        $ip = "8.8.8.8.8";
        $valid = "True";
        $host = "dns.google";

        $_POST["ip"] = $ip;
        $res = $this->controller->indexActionPost();

        $json = [[
            "ip" => $ip,
            "valid" => "False",
            "host" => "None found",
        ]];

        $this->assertEquals($json, $res);
    }
}
