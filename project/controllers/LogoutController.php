<?php
	namespace Project\Controllers;
	use \Core\Controller;
	
	class LogoutController extends Controller
	{
		public function logout() {
            session_start();
            session_destroy();
			setcookie("user", "", time());
            header("Location: /");
            return $this->render('auth/login');;
		}
	}