<?php
	namespace Project\Models;
	use \Core\Model;
	
	class Signup extends Model{
        public function getUserExists($login, $email){
            return $this -> findOne("SELECT * FROM users WHERE login = '$login' OR email = '$email'");
        }
        public function setNewUser($fName, $lName, $login, $email, $password, $phone){
            return $this -> insert("INSERT INTO users SET f_name = \"$fName\", l_name=\"$lName\", login=\"$login\", email=\"$email\", password=\"".md5($password)."\", phone=\"$phone\"");
        }
        public function getUserId(){
            return mysqli_insert_id($this -> getLink());
        }
    }