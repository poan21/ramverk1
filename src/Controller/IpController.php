<?php

namespace Anax\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class IpController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    private $db = "not active";



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

        $data = [
        ];

        $title = "IP Checker";

        $page = $this->di->get("page");

        $page->add("ip/ip_form", $data);

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
        $valid = "False";
        $host = "None found";

        $val = $this->checkIp->validIp($ip);

        if ($val) {
            $valid = "True";
        } else {
            $valid = "False";
        }

        $host = $this->checkIp->validHost($ip);

        if ($host == false) {
            $host = "Not found";
        }

        $data = [
            "ip" => $ip,
            "valid" => $valid,
            "host" => $host
        ];

        $page = $this->di->get("page");

        $page->add("ip/ip_res", $data);

        return $page->render([
            "title" => $title,
        ]);
    }
}
