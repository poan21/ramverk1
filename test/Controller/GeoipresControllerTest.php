<?php

namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class GeoipresControllerTest extends TestCase
{

    public function setUp()
    {
        global $di;

        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        $di = $this->di;

        $this->controller = new GeoipresController();
        $this->controller->setDI($this->di);
        $this->controller->initialize();
        $this->request = $this->di->get("request");
    }

    public function testindexActionGet()
    {

        $ip = "8.8.8.8";
        $valid = "True";
        $ip_type = "ipv4";
        $country_name = "United States";
        $city = "Mountain View";
        $region = "California";

        $this->request->setGet("ip", $ip);
        $res = $this->controller->indexActionGet();

        $json = [[
            "ip" => $ip,
            "valid" => "True",
            "ip_type" => $ip_type,
            "country_name" => $country_name,
            "city" => $city,
            "region" => $region
        ]];

        $this->assertEquals($json, $res);
    }

    public function testindexActionGetFalse()
    {

        $ip = "8.8.8.8.8";
        $valid = "True";
        $host = "dns.google";

        $this->request->setGet("ip", $ip);
        $res = $this->controller->indexActionGet();

        $json = [[
            "ip" => null,
            "valid" => "False",
            "ip_type" => null,
            "country_name" => null,
            "city" => null,
            "region" => null
        ]];

        $this->assertEquals($json, $res);
    }

    public function testindexActionPost()
    {

        $ip = "8.8.8.8";
        $valid = "True";
        $ip_type = "ipv4";
        $country_name = "United States";
        $city = "Mountain View";
        $region = "California";

        $this->request->setPost("ip", $ip);
        $res = $this->controller->indexActionPost();

        $json = [[
            "ip" => $ip,
            "valid" => "True",
            "ip_type" => $ip_type,
            "country_name" => $country_name,
            "city" => $city,
            "region" => $region
        ]];

        $this->assertEquals($json, $res);
    }



    public function testindexActionPostFalse()
    {

        $ip = "8.8.8.8.8";
        $valid = "True";
        $host = "dns.google";

        $this->request->setPost("ip", $ip);
        $res = $this->controller->indexActionPost();

        $json = [[
            "ip" => null,
            "valid" => "False",
            "ip_type" => null,
            "country_name" => null,
            "city" => null,
            "region" => null
        ]];

        $this->assertEquals($json, $res);
    }
}
