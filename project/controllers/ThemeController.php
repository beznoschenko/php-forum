<?php

namespace Project\Controllers;

use \Core\Controller;

use \Project\Models\Theme;
use \Project\Models\Main;

class ThemeController extends Controller
{
    private $data;
   

    public function __construct()
    {
        $this->topics = new Theme;
        //$this -> show($params);
    } 
    public function print_double_array($arr)
    {
        foreach ($arr as $value) {
            foreach ($value as $val) {
                echo $val . " ";
            }
            echo "<br>";
        }
    }
    public function comments($comments, $topicId)
    {
        $commentList = [];
        //$key = 0;

        foreach ($comments as $key => $elem) {
            $commentList[$key] = $elem;
            $commentList[$key]['user_name'] = $this->topics->getUserName($elem['user_id'])['login'];
            if ($result = $this->topics->getParrentComment($elem["id"])) {
                $commentList[$key]['child'] = $this->comments($result, $topicId);
            }
            //$key++;
        }

        return $commentList;
    }

    function error_handler($errno, $errstr) {
        if($errno == E_WARNING) {
            throw new WarningException($errstr);
        } else if($errno == E_NOTICE) {
            throw new NoticeException($errstr);
        }
    }
    public function topicData($params)
    {
        
        try {
            $result = $this->topics->getTopicName($params['topid']);
            $result["author_login"] = $this->topics->getUserName($result['author_id'])['login'];
            echo json_encode($result);
            exit();
        } catch(Notice $ex){
            header("Location: /error");
        }
    }
    public function ajaxshow($params)
    {
        session_start();
        $this->data =  $this->topics->getComments($params['topid']);
        $commentsList = $this->comments($this->data, $params['topid']);
        echo json_encode($commentsList);
        exit();
    }
    public function added($params)
    {
        session_start();
        if ($_POST["parrent_id"]) {
            $result = $this->topics->setComment($params['topid'],  $_SESSION['auth'], $_POST['text'], $_POST["parrent_id"]);
        } else {
            $result = $this->topics->setComment($params['topid'],  $_SESSION['auth'], $_POST['text']);
        }
        $result["user_name"] = $this->topics->getUserName($result['user_id'])['login'];
        echo  json_encode($result);
        exit();
    }

    public function delete($id)
    {
        $this->topics->deleteComment($_POST['id']);
        $this->topics->deleteChildComment($_POST['id']);
        echo true;
        exit();
    }

    public function show($params)
    {
        session_start();
        $this->title = $this->topics->getTopicName($params['topid'])['title'];
        return $this->render('theme/theme');
    }
}
