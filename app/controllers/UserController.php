<?php

namespace Controllers;

use Kernel\Application;
use Kernel\Response;
use Kernel\Validator;
use Kernel\View;
use Models\User;
use Services\UserService;

class UserController
{
    // show index page
    public function index()
    {
        $user = UserService::getCurrentUser();
        return View::make('index')->with('user', $user)->with('pageTitle', 'Index page');
    }

    // show register form
    public function registerForm()
    {
        return View::make('register')->with('pageTitle', 'Sign in');
    }

    // register a user
    public function register()
    {
        $request = Application::getRequest();

        $user = new User(Application::getRequest()->all());
        $user->file = $request->file('filename');
        $user->password_confirmed = $request->get('password_confirmed');
        $errors = Validator::validate($user);

        if (empty($errors) && $user->insert()) {
            if (UserService::saveUploadedFile($user)) {
                $user->filename = $user->file->getClientOriginalName();
                $user->update();
            }

            UserService::setCurrentUser($user);

            return Response::redirectUrl('/register_done');
        }

        View::share('user', $user);
        View::share('errors', $errors);

        return $this->registerForm();
    }

    // show register's done page
    public function registerDone()
    {
        $user = UserService::getCurrentUser();

        if ($user instanceof User) {
            return View::make('register_done')->with('user', $user)->with('pageTitle', 'Register done');
        } else {
            return View::make('access_restricted');
        }
    }

    // show login form
    public function loginForm()
    {
        return View::make('login')->with('pageTitle', 'Login');
    }

    // make login
    public function login()
    {
        $user = new User(Application::getRequest()->all());
        $validateRules = [
            'email' => 'email',
            'password' => 'required',
        ];
        $errors = Validator::validate($user, $validateRules);

        if (empty($errors)) {
            $isSuccess = UserService::authorize($user->email, $user->password);

            $responseData = ['success' => $isSuccess];
            if ($isSuccess) {
                $responseData['redirect'] = '/';
            } else {
                $responseData['errors'] = [UserService::ERROR_USER_NOT_FOUND];
            }

            return Response::json($responseData);
        } else {
            return Response::json(['success' => false, 'errors' => $errors]);
        }
    }

    // make logout
    public function logout()
    {
        UserService::logout();

        return Response::redirectUrl('/');
    }
}