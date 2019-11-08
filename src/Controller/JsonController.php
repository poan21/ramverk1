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
class JsonController implements ContainerInjectableInterface
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
        $valid = "False";
        $host = "None found";

        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            $valid = "True";
            if (gethostbyaddr($ip) != $ip) {
                $host = gethostbyaddr($ip);
            }
        }

        $json = [
            "ip" => $ip,
            "valid" => $valid,
            "host" => $host,
        ];

        return [$json];
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
        $valid = "False";
        $host = "None found";

        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            $valid = "True";
            if (gethostbyaddr($ip) != $ip) {
                $host = gethostbyaddr($ip);
            }
        }

        $json = [
            "ip" => $ip,
            "valid" => $valid,
            "host" => $host,
        ];

        return [$json];
    }
}
