<?php

namespace App\Request;

use CodeIgniter\HTTP\RequestInterface;


class CategoryController {
    protected $request;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }


    public function rules() {
        // "name" => [

        // ]
    }
}