<?php

namespace Moody\ControllerIP;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class JsonIpValidatorController1 extends IpValidate implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    /**
     * @var string
     */
    private $enteredIp;
    private $ipValidatorClass;

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountPoint
     * ANY METHOD mountPoint/
     * ANY METHOD mountPoint/index
     *
     * @return string
     */
    public function indexAction() : array
    {
        $title = "IP validator with JSON response";
        $page = $this->di->get("page");
        $request = $this->di->get("request");
        $this->enteredIp = $request->getGet("ip");
        $this->ipValidatorClass = new IpValidate();
        $json = $this->ipToJson($this->enteredIp, $this->ipValidatorClass);
        $data['json'] = $json;

        return $data['json'];
    }

        /**
     * This is the index method action, it handles:
     * ANY METHOD mountPoint
     * ANY METHOD mountPoint/
     * ANY METHOD mountPoint/index
     *
     * @return string
     */
    public function jsonIpActionGet() : array
    {
        $title = "IP validator with JSON response";
        $page = $this->di->get("page");
        $request = $this->di->get("request");
        $this->enteredIp = $request->getGet("ip");
        $this->ipValidatorClass = new IpValidate();
        $json = $this->ipToJson($this->enteredIp, $this->ipValidatorClass);
        $data['json'] = $json;

        return $data['json'];
    }


    /**
     * Check if IP is valid or not and return with host.
     * GET ip
     *
     * @return array
     */
    public function ipToJson($ipAddress, $object) : array
    {
        $json = [
            "Protocol" => $object->getProtocol($ipAddress) ?? null,
            "Domain" => $object->getDomain($ipAddress) ?? null,
            "address" => $object->getAddress($ipAddress) ?? null,
        ];
        return [$json];
    }
}
