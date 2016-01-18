<?php

namespace Kernel;

class FileBag extends ParameterBag
{
    protected $parameters;

    public function __construct(array $parameters = [])
    {
        parent::__construct($parameters);

        $this->parameters = [];
        foreach ($parameters as $key => $parameter) {
            $this->parameters[$key] = new UploadedFile($parameter);
        }
    }
}