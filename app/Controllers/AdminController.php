<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\CIAuth;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\User;

class AdminController extends BaseController
{

    protected $helpers = ["url", "form", "CIMail", "CIFunctions"];
    public function index()
    {
        $data = [
            "title" => "Dashboard",
            "validation" => null
        ];
        return view("pages/dashboard", $data);
    }

    public function profile()
    {
        return view("pages/profile", [
            "title" => "Profile",
            "validation" => null
        ]);
    }

    public function updateProfile() {
        $request = service("request");
        $validation = service("validation");
        $userId = CIAuth::id();

        if ($request->isAJAX()) {
            $this->validate($this->loginRequest->rules($userId));

            if ($validation->run() == FALSE) {
                
            }
        }

    }
}
