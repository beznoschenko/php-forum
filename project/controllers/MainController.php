<?php

namespace Project\Controllers;

use \Core\Controller;
use \Project\Models\Main;
use \Project\Models\Theme;


class MainController extends Controller
{
	public function __construct()
	{
		$this->themesData = new Main;
		$this->topic =  new Theme;
	}

	public function table()
	{
		session_start();
		$result = $this->themesData->getThemes();
		foreach ($result as &$topic) {
			$topic["user_name"] = $this->topic->getUserName($topic['author_id'])['login'];
		}
		echo json_encode($result);
		exit();
	}

	public function add()
	{
		session_start();
		$result = $this->themesData->setTheme($_POST['title'], $_POST['description'], $_SESSION['auth']);
		$result['user_name']  = $this->topic->getUserName($result['author_id'])['login'];
		echo json_encode($result);
		exit();
	}

	public function delete()
	{
		$this->themesData->deleteTopic($_POST['id']);
		$this->themesData->deleteComments($_POST['id']);
		echo true;
		exit();
	}

	public function index()
	{
		session_start();
		$this->title = 'It\'s work!';
		return $this->render('main/index');
	}
}
