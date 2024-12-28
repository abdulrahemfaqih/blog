<?php

namespace App\Request;

use CodeIgniter\HTTP\RequestInterface;



class EmailRequest
{
    protected $request;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    public function rules()
    {
        return [
            "email" => [
                "rules" => "required|valid_email|is_not_unique[users.email]",
                "errors" => [
                    "required" => "Email wajib diisi",
                    "valid_email" => "email tidak valid",
                    "is_not_unique" => "Email tidak terdaftar"

                ]
            ]
        ];
    }
}
