<?php


namespace App\Request;

use CodeIgniter\HTTP\RequestInterface;

class ResetPasswordRequest
{
    protected $request;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    public function rules()
    {
        return [
            "new_password" => [
                "rules" => "required|min_length[5]|max_length[20]|is_password_strong[new_password]",
                "errors" => [
                    "required" => "Password baru wajib diisi",
                    "min_length" => "Password harus lebih dari 5 karakter",
                    "max_length" => "Password harus kurang dari 20 karakter",
                    "is_password_strong" => "password baru harus mengandung 1 huruf besar, 1 huruf kecil, angka dan 1 spesial karakter"


                ]
            ],
            "confirm_new_password" => [
                "rules" => "required|matches[new_password]",
                "errors" => [
                    "required" => "Konfirmasi password wajib diisi",
                    "matches" => "Konfirmasi password tidak cccok"
                ]
            ]
        ];
    }
}
