<?php

namespace App\Request;

use CodeIgniter\HTTP\RequestInterface;

class LoginRequest
{
    protected $request;


    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    public function rules()
    {
        $loginId = $this->request->getVar("login_id");
        $fieldType = filter_var($loginId, FILTER_VALIDATE_EMAIL) ? "email" : "username";

        return [
            "login_id" => [
                "rules" => $fieldType === "email"
                    ?  "required|valid_email|is_not_unique[users.email]"
                    : "required|is_not_unique[users.username]",
                'errors' => [
                    'required' => ucfirst($fieldType) . ' wajib diisi',
                    'valid_email' => 'Email tidak valid',
                    'is_not_unique' => $fieldType . ' tidak terdaftar'
                ]
            ],
            "password" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Password wajib diisi",
                ]
            ]
        ];
    }
}
