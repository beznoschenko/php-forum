<?php
	namespace Project\Models;
	use \Core\Model;
	
	class Main extends Model
	{
		public function getThemes(){
			return $this -> findMany("SELECT * FROM themes WHERE delete_flag = 0 ORDER BY date DESC");
		}
		public function getAuthor($id){
			return $this -> findOne("SELECT login FROM users WHERE id=$id")['login'];
		}
		public function setTheme($title, $description, $id ){
			$this ->insert("INSERT INTO themes SET title='$title', description='$description', author_id='$id', date=NOW()");
			return $this -> getTopic(mysqli_insert_id($this -> getLink()));
		}
		public function deleteTopic($id){
			return $this -> delete("UPDATE themes SET delete_flag = 1 WHERE id = $id");
		}
		public function deleteComments($id){
			return $this -> delete("UPDATE comments SET delete_flag=1 WHERE theme_is=$id");
		}
		public function getAddedTopic($id){
			return $this -> findOne("SELECT * FROM themes WHERE id=$id");
		}
		public function getTopic($id)
		{
			return $this->findOne("SELECT * FROM themes WHERE id=$id");
		}
	}
