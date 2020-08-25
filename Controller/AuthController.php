<?php


class AuthController
{

    protected $conn;
    protected $query;

    public function __construct()
    {

        $config = require('config.php');
        $this->conn = Connection::create($config);
        $this->query = new Auth($this->conn);
    }



    public function login()
    {

        require('views/auth/login.php');
    }

    public function signup()
    {

        require('views/auth/signup.php');
    }

    public function register()
    {

        if (isset($_POST['signup'])) {
            $username = $_POST['username'];
            $result = $this->query->getByUsername($username);
            if (!empty($result)) {
                session_start();
                $_SESSION['message'] = "Username exists";
                header("Location: /signup");
                return;
            }
            if (strlen($_POST['password']) < 6) {
                session_start();
                $_SESSION['message'] = "Password is too short";
                header("Location: /signup");
                return;
            }
            if ($_POST['password'] != $_POST['confirm-password']) {
                session_start();
                $_SESSION['message'] = "Passwords don't match";
                header("Location: /signup");
                return;
            }
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $this->query->insert($username, $password);
            $result = $this->query->getByUsername($username);
            $user = $result;
        }

        $_SESSION['id'] = $user[0]['id'];
        $_SESSION['username'] = $user[0]['username'];

        header("Location: /main");
    }


    public function check()
    {
        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $result = $this->query->getByUsername($username);
            $user = "";

            if (empty($result)) {
                session_start();
                $_SESSION['message'] = "Incorrect username";
                header("Location: /");
                return;
            } else {
                if (password_verify($password, $result[0]['password'])) {
                    $user = $result;
                } else {
                    session_start();
                    $_SESSION['message'] = "Incorrect password";
                    header("Location: /");
                    return;
                }
            }
        }

        $_SESSION['id'] = $user[0]['id'];
        $_SESSION['username'] = $user[0]['username'];

        header("Location: /main");
    }


    public function signout()
    {
        session_start();
        unset($_SESSION['id']);
        header("Location: /");
    }
}
