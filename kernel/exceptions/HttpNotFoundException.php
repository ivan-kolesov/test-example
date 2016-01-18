<?php

namespace Kernel\Exceptions;

use Kernel\Config;
use Kernel\Response;
use Kernel\View;

class HttpNotFoundException extends BaseException
{
    public function handle()
    {
        $view = View::make(Config::get('app.errorsPages.404', '404'))->with('pageTitle', 'Not found');

        $response = new Response();
        $response->setStatusCode(404);
        $response->setContent($view->render());
        return $response;
    }
}