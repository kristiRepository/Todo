<?php



class Middleware
{

    public static function notLoggedIn()
    {

        session_start();
        if (!isset($_SESSION['id'])) {
            header("Location: /");
            return true;
        } else {
            return false;
        }
    }

    public static function loggedIn()
    {

        session_start();
        if (isset($_SESSION['id'])) {
            header("Location: /main");
            return true;
        } else {
            return false;
        }
    }
}
