<?php

namespace Kernel;

class UploadedFile
{
    private $name;
    private $type;
    private $size;
    private $tmpName;
    private $error;

    public function __construct(array $parameters)
    {
        $this->name = Arr::get($parameters, 'name');
        $this->type = Arr::get($parameters, 'type');
        $this->size = Arr::get($parameters, 'size');
        $this->tmpName = Arr::get($parameters, 'tmp_name');
        $this->error = Arr::get($parameters, 'error');
    }

    /**
     * @return string
     */
    public function getClientOriginalName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getClientContentType()
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getClientSize()
    {
        return $this->size;
    }

    /**
     * @return int
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        $isErrorOk = $this->error === UPLOAD_ERR_OK;
        return $isErrorOk && is_uploaded_file($this->tmpName);
    }

    /**
     * @param $destination
     * @return bool
     */
    public function move($destination)
    {
        if ($this->isValid()) {

            $status = move_uploaded_file($this->tmpName, $destination);
            @chmod($destination, 0666 & ~umask());

            return $status;
        }

        return false;
    }

    /**
     * @return string|null
     */
    public function getExtension()
    {
        $segs = explode('/', $this->type);
        return !empty($segs) ? $segs[1] : null;
    }
}