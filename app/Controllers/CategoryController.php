<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Category;

class CategoryController extends BaseController
{
    protected $helpers = ["url", "form", "CIMail", "CIFunctions"];
    public function displayCategory()
    {
        // $categories =
        return view("pages/category", [
            "title" => "Category",

        ]);
    }

public function storeCategory() {}


    public function displaySubCategory()
    {
        return view("pages/sub_category", [
            "title" => "Sub Category",
            "active" => "1"
        ]);
    }

    public function storeSubCategory() {}
}
