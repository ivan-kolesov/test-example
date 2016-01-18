<?php

namespace Kernel\Exceptions;

use Kernel\Config;
use Kernel\Response;
use Kernel\View;

class HttpForbiddenException extends BaseException
{
    public function handle()
    {
        $view = View::make(Config::get('app.errorsPages.403', '403'))->with('pageTitle', 'Forbidden');

        $response = new Response();
        $response->setStatusCode(403);
        $response->setContent($view->render());
        return $response;
    }
}