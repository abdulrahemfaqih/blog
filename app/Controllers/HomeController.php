<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\CIAuth;

class HomeController extends BaseController
{
    public function index()
    {
        if (CIAuth::check()) {
            return redirect()->route("admin.dashboard");
        }

        return redirect()->route("admin.login");
    }
}
