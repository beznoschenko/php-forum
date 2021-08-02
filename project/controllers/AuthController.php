<?php

namespace Project\Controllers;

use \Core\Controller;

use \Project\Models\Login;

class AuthController extends Controller
{
    public function login()
    {   
        session_start();
        $message= ["error" => ""];
        $login = new Login;

        $this->title = "Login";
        if (isset($_SESSION['auth'])){
            header("Location: /");
        }
        else{
        if (!empty($_POST['login']) and !empty($_POST['password'])) {
            $log = $_POST['login'];
            $pas = $_POST['password'];
            $data = $login->getUserData($log, $pas);
            if ($data) {
                $_SESSION['auth']=$data["id"];
                setcookie('user', $_SESSION['auth']);
                header("Location: /");
            } 
            else {
                $message = ["error" => "Invalid data"];
            }
            
        }
        return $this->render('auth/login', $message);
    }
}
}
