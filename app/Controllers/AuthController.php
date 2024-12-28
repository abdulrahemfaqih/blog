<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\CIAuth;
use App\Request\LoginRequest;
use App\Service\AuthService;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    protected $loginRequest;
    protected $authService;

    public function __construct()
    {
        $this->loginRequest = new LoginRequest(service("request"));
        $this->authService = new AuthService();
    }

    public function loginForm()
    {
        $data = [
            "title" => "Login"
        ];
        return view("auth/login", $data);
    }


    public function loginHandler()
    {
        if (!$this->validate($this->loginRequest->rules())) {
            return view("auth/login", [
                "title" => "Login",
                "validator" => $this->validator
            ]);
        }

        $loginId = $this->request->getVar("login_id");
        $password = $this->request->getVar("password");

        $user = $this->authService->attempLogin($loginId, $password);

        if (!$user) {
            return redirect()->back()
                ->withInput()
                ->with('fail', 'Password atau email/username tidak cocok');
        }
        CIAuth::setCIAuth($user);
        return redirect()->route('admin.dashboard');
    }
}
