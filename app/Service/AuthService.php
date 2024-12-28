<?php

namespace App\Service;

use App\Models\User;

class AuthService
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function attempLogin($loginId, $password)
    {
        $fieldType = filter_var($loginId, FILTER_VALIDATE_EMAIL) ? "email" : "username";

        $user = $this->userModel->where($fieldType, $loginId)->first();

        if (!$user || !password_verify($password, $user["password"])) {
            return null;
        }

        return $user;
    }
}
