<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\CIAuth;
use App\Libraries\Hash;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{

    public function loginForm()
    {
        $data = [
            "title" => "Login"
        ];
        return view("login", $data);
    }


    public function loginHandler() {
        $fieldType = filter_var($this->request->getVar("login_id"), FILTER_VALIDATE_EMAIL) ? "email" : "username";
        if ($fieldType == "email") {
            $isValid = $this->validate([
                "login_id" => [
                    "rules" => "required|valid_email|id_not_unique[users.email]",
                    "errors" => [
                        "required" => "Email wajin diisi",
                        "valid_email" => "Email tidak valid",
                        "is_not_unique" => "Email tidak terdaftar"
                    ]
                    ],
                    "password" => [
                        "rules" => "required|min_length[5]|max_length[45]",
                        "errors" => [
                            "ruquired" => "Password wajib diisi"
                        ]
                    ]
            ]);
        }
    }
}
