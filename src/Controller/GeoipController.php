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
class GeoipController implements ContainerInjectableInterface
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
        $this->curlIp = new CurlIp();
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

        $data = [
        ];

        $page->add("ip/geoip_form", $data);

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

        $val = $this->checkIp->validIp($ip);
        $api_res = false;

        if ($val) {
            $valid = "True";
            $api_res = $this->curlIp->curl($ip);
        } else {
            $valid = "False";
        }

        $data = [
            "ip" => $api_res['ip'],
            "ip_type" => $api_res['type'],
            "country_name" => $api_res['country_name'],
            "city" => $api_res['city'],
            "region" => $api_res['region_name']
        ];

        $page->add("ip/geoip_res", $data);

        return $page->render([
            "title" => $title,
        ]);
    }
}
