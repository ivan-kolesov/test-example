<?php

namespace Kernel;

class Route
{
    protected $uri;
    protected $methods;
    protected $action;

    public function __construct($methods, $uri, $action)
    {
        $this->uri = $uri;
        $this->methods = (array) $methods;
        $this->action = $action;
    }

    public function getMethods()
    {
        return $this->methods;
    }

    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return Response
     */
    public function run()
    {
        $response = new Response();

        $segs = explode('@', $this->action);

        $controller = new $segs[0];

        $result = call_user_func_array([$controller, $segs[1]], []);

        if ($result instanceof View) {
            $response->setContent($result->render());
        } elseif ($result instanceof Response) {
            $response = $result;
        }

        return $response;
    }
}