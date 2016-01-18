<?php

namespace Kernel;

class ParameterBag
{
    protected $parameters;

    public function __construct(array $parameters = [])
    {
        $this->parameters = $parameters;
    }

    /**
     * @param $name
     * @param null $default
     * @return mixed
     */
    public function get($name, $default = null)
    {
        if (!array_key_exists($name, $this->parameters)) {
            return $default;
        }

        return $this->parameters[$name];
    }

    /**
     * @param $name
     * @param $value
     */
    public function append($name, $value)
    {
        $this->parameters[$name][] = $value;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->parameters;
    }
}