<?php


namespace App\Libraries;
use App\Models\User;

class CIAuth
{
    public static function setCIAuth($result)
    {
        $session = session();
        $session->set([
            "logged_in" => true,
            "userData" => $result,
        ]);
    }

    public static function id()
    {
        $session = session();
        if (!$session->has("logged_in") || !$session->has("userData")) {
            return null;
        }
        $userData = $session->get("userData");
        return $userData["id"] ?? null;
    }

    public static function check() {
        $session = session();
        return $session->has("logged_in");
    }

    public static function forget() {
        $session = session();
        $session->remove("logged_in");
        $session->remove("userData");
    }


    public static function user() {
        $session = session();
        if (!$session->has("logged_in") || !$session->has("userData")) {
            return null;
        }

        $user = new User();
        return $user->asObject()->where("id", CIAuth::id())->first();
    }
}
