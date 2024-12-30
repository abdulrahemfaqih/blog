<?php

use App\Libraries\CIAuth;
use App\Models\User;

if (!function_exists("getUser")) {
    function getUser()
    {
        if (CIAuth::check()) {
            $user = new User();
            return $user->asObject()->where("id", CIAuth::id())->first();
        }
        return null;
    }
}
