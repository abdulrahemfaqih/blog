<?php

namespace App\Request;

use CodeIgniter\HTTP\RequestInterface;

class ProfileRequest
{
    protected $request;
    protected $userId;

    public function __construct(RequestInterface $request, $userId)
    {
        $this->request = $request;
        $this->request = $userId;
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
                "rules" => "required|min_length[4],is_unique[ursers.username,id,'.$userId.']",
                "errors" => [
                    "required" => "Username wajib diisi",
                    "min_length" => "Username minimal 4 karakter",
                    "is_unique" => "Username sudah ada"
                ]
            ],
            "email" => [
                "rules" => "required",
                "errors" => [
                    "required" => "Email wajib diisi",
                ]
            ],


        ];
    }
}
