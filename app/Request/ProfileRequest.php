<?php

namespace App\Request;

use CodeIgniter\HTTP\RequestInterface;

class ProfileRequest
{
    protected $request;


    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }


    public function rules($userId)
    {
        return [
            "name" => [
                "rules" => "required",
                "error" => [
                    "required" => "Nama wajib diisi"
                ]
            ],
            "username" => [
                "rules" => "required|min_length[4]|is_unique[users.username,id,$userId]",
                "errors" => [
                    "required" => "Username wajib diisi",
                    "min_length" => "Username minimal 4 karakter",
                    "is_unique" => "Username sudah ada"
                ]
            ],
            "email" => [
                "rules" => "required|valid_email",
                "errors" => [
                    "required" => "Email wajib diisi",
                    "valid_email" => "Format email tidak sesuai"
                ]
            ],


        ];
    }
}
