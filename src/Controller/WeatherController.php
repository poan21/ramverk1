<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class WeatherController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    private $db = "not active";
    private $checkIp;



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    public function initialize() : void
    {
        // Use to initialise member variables.
        $this->db = "active";
        $this->checkIp = new CheckIp();
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function indexAction() : object
    {
        $title = "Geo IP Checker";

        $page = $this->di->get("page");

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            if (isset($_SERVER['REMOTE_ADDR'])) {
                $ip = $_SERVER['REMOTE_ADDR'];
            } else {
                $ip = "No ip";
            }
        }

        $data = [
            "ip" => $ip
        ];

        $page->add("ip/weather_form", $data);

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function indexActionPost() : object
    {
        $title = "IP Checker";

        $request = $this->di->get("request");
        $page = $this->di->get("page");

        $ip = $request->getPost("ip");

        $output = $request->getPost("days");

        $val = $this->checkIp->validIp($ip);
        $api_res = false;

        if ($val) {
            $valid = true;
            $api_res = $this->di->get("ipstack")->curl($ip);
            $res = $this->di->get("darksky")->multiCurl($api_res, $output);
        } else {
            $valid = false;
            $res = "None";
        }


        $data = [
            "valid" => $valid,
            "res" => $res,
        ];

        $page->add("ip/weather_res", $data);

        return $page->render([
            "title" => $title,
        ]);
        // var_dump($json);
    }
}
