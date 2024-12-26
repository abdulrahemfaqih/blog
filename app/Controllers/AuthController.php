<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function index()
    {
        //
    }

    public function loginForm()
    {
        $data = [
            "title" => "Login"
        ];
        return view("login", $data);
    }


    public function loginHandler() {
       
    }
}
