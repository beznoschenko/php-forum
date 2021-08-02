<?php

namespace Project\Controllers;

use \Core\Controller;

use \Project\Models\Signup;

class RegisterController extends Controller
{
    public function signup()
    {
        session_start();
        $register = new Signup;
        $message = ["error" => ""];
        $this->title = "register";
        if (isset($_SESSION['auth'])) {
            header("Location: /");
        } else {

            if (!empty($_POST['signup'])) {
                if (!$register->getUserExists($_POST['login'], $_POST['email'])) {

                    if (!preg_match('#^[a-zA-z0-9]{4,}$#', $_POST['login'])){
                        $message = ["error" => "Login error"];
                    }
                    elseif ($_POST['password'] === $_POST['c_password']) {
                        header("Location: /");
                        if ($register->setNewUser($_POST['f_name'], $_POST['l_name'], $_POST['login'], $_POST['email'], $_POST['password'], $_POST['phone'])) {
                            $_SESSION['auth'] = $register->getUserId();
                            setcookie('user', $_SESSION['auth']);
                        }
                    } else {
                        $message = ["error" => "Password mismatch"];
                    }
                } else {
                    $message = ["error" => "This user already exists"];
                }
            }
            return $this->render('register/signup', $message);
        }
    }
}
