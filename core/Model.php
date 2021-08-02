<?php
	namespace Core;
	
	class Model
	{
		private static $link;
		
		public function __construct()
		{
			if (!self::$link) {
				self::$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
				mysqli_query(self::$link, "SET NAMES 'utf8'");
			}
		}

		protected function findOneBind($query, String $tags, Array $params)
		{
			$quer = mysqli_prepare(self::$link, $query);
			mysqli_stmt_bind_param($quer, $tags, ...$params);
			mysqli_stmt_execute($quer);
			$result = mysqli_stmt_get_result($quer);
			return mysqli_fetch_assoc($result);
       
		}		

		protected function findOne($query){
			$result = mysqli_query(self::$link, $query) or die(mysqli_error(self::$link));
			return mysqli_fetch_assoc($result);
		}


		protected function findMany($query)
		{
			$result = mysqli_query(self::$link, $query) or die(mysqli_error(self::$link));
			for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
			
			return $data;
		}
		protected function insert($query)
		{
			return mysqli_query(self::$link, $query) or die(mysqli_error(self::$link));
		}

		protected function delete($query){
			return mysqli_query(self::$link, $query) or die(mysqli_error(self::$link));
		}

		protected function multiDelete($query){
			return mysqli_multi_query(self::$link, $query) or die(mysqli_error(self::$link));

		}
		protected function getLink(){
			return $this::$link;
		}
	}
