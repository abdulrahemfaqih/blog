<?php


namespace App\Libraries;

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
        $userData = $session->get("UserData");
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
        $userData = $session->get("UserData");
        return $userData ?? null;
    }
}
