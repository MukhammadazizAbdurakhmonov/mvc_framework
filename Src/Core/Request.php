<?php 

namespace Src\Core;

/**
 * Responsible for global requests
 */
class Request
{
    /**
     * Server global varibale for incoming request uri
     * @var string
     */
    public string $uri;

    /**
     * Server global varibale for request method 
     * @var string
     */
    public string $method;

    /**
     * Global GET mehthod
     * @var array
     */
    public array $get;

    /**
     * Global POST method
     * @var array
     */
    public array $post;

    /**
     * Global FILES method
     * @var array
     */
    public array $files;

    /**
     * Global COOKIE method
     * @var array
     */
    public array $cookie;

    /**
     * Global SERVER method
     * @var array
     */
    public array $serve;

    public function __construct()
    {
        $this->uri = $_SERVER["REQUEST_URI"];
        $this->method = $_SERVER["REQUEST_METHOD"];
        $this->get = $_GET;
        $this->post = $_POST;
        $this->files = $_FILES;
        $this->cookie = $_COOKIE;
        $this->serve = $_SERVER;
    }
}