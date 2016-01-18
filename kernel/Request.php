<?php

namespace Kernel;

class Request
{
    /**
     * @var ParameterBag
     */
    private $query;
    /**
     * @var ParameterBag
     */
    private $request;
    /**
     * @var FileBag
     */
    private $files;

    private $method;

    private $baseUrl;

    public function __construct(array $query = [], array $request = [])
    {
        $this->query = new ParameterBag($query);
        $this->request = new ParameterBag($request);
        $this->files = new FileBag($_FILES);

        $this->method = !empty($_SERVER['REQUEST_METHOD']) ? strtoupper($_SERVER['REQUEST_METHOD']) : 'GET';

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
            if (isset($_SERVER['HTTP_CONTENT_TYPE']) && false !== strrpos($_SERVER['HTTP_CONTENT_TYPE'], 'application/json')) {
                $json = json_decode(file_get_contents("php://input"), true);
                if (false !== $json) {
                    $this->request = new ParameterBag($json);
                }
            }
        }
    }

    /**
     * @param $name
     * @param null $default
     * @return mixed
     */
    public function get($name, $default = null)
    {
        if ($result = $this->query->get($name, $default)) {
            return $result;
        }

        if ($result = $this->request->get($name, $default)) {
            return $result;
        }

        return $default;
    }

    /**
     * @return array
     */
    public function all()
    {
        return array_merge_recursive($this->query->all(), $this->request->all());
    }

    /**
     * @param $name
     * @return UploadedFile|null
     */
    public function file($name)
    {
        if ($result = $this->files->get($name)) {
            return $result;
        }
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasFile($name)
    {
        return !empty($this->files->get($name));
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        if (is_null($this->baseUrl)) {
            $this->baseUrl = $this->prepareBaseUrl();
        }

        return $this->baseUrl;
    }

    /**
     * @return string
     */
    private function prepareBaseUrl()
    {
        preg_match('/([^?]+)\?*/', $_SERVER['REQUEST_URI'], $match);
        return !empty($match) ? $match[1] : '/';
    }
}