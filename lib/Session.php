<?php


class Session
{

    public static function start()
    {
        ob_start();
        session_start();
    }


    public static function inSystem()
    {

        return isset($_SESSION['user']);

    }

    public static function isOwner()
    {

        $s = false;

        if (isset($_SESSION['user']) && $_SESSION['role_id'] && $_SESSION['user'] == 1) {
            $s = true;
        }


        return $s;

    }

    public static function isUser()
    {
        $s = false;

        if (isset($_SESSION['user']) && $_SESSION['role_id'] && $_SESSION['user'] == 2) {
            $s = true;
        }


        return $s;

    }

}