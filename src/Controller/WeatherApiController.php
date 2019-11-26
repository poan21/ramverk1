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
class WeatherApiController implements ContainerInjectableInterface
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
    public function indexActionGet() : array
    {
        $request = $this->di->get("request");

        $ip = $request->getGet("ip");
        $output = $request->getGet("days");
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

        $mainjson = [];
        $count = 1;

        if ($valid) {
            if (isset($res['error'])) {
                $mainjson = [
                    "error" => "Can't read weather from this location.",
                ];
            }
            foreach ($res as $oneday) {
                $json = [
                    "date" => date("Y-m-d", $oneday['daily']['data'][0]['time']),
                    "summary" => $oneday['daily']['data'][0]['summary'],
                    "highest_temp" => number_format((($oneday['daily']['data'][0]['temperatureMax']-32)/1.8), 1),
                    "lowest_temp" => number_format((($oneday['daily']['data'][0]['temperatureMin']-32)/1.8), 1)
                ];

                $mainjson[$count] = $json;
                $count++;
            }
        } else {
            $mainjson = [
                "error" => 'No location found',
            ];
        }



        return [$mainjson];
    }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return object
     */
    public function indexActionPost() : array
    {
        $request = $this->di->get("request");

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
        $mainjson = [];
        $count = 1;

        if ($valid) {
            if (isset($res['error'])) {
                $mainjson = [
                    "error" => "Can't read weather from this location.",
                ];
            }
            foreach ($res as $oneday) {
                $json = [
                    "date" => date("Y-m-d", $oneday['daily']['data'][0]['time']),
                    "summary" => $oneday['daily']['data'][0]['summary'],
                    "highest_temp" => number_format((($oneday['daily']['data'][0]['temperatureMax']-32)/1.8), 1),
                    "lowest_temp" => number_format((($oneday['daily']['data'][0]['temperatureMin']-32)/1.8), 1)
                ];

                $mainjson[$count] = $json;
                $count++;
            }
        } else {
            $mainjson = [
                "error" => 'No location found',
            ];
        }


        return [$mainjson];
    }
}
