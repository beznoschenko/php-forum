<?php
	namespace Project\Models;
	use \Core\Model;
	
	class Login extends Model{
        public function getUserData($login, $pass){
            return $this -> findOne("SELECT * FROM users WHERE ( login = \"$login\" OR email = \"$login\") AND password=\"".md5($pass)."\"");

        }
    }