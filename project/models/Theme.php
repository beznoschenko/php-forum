<?php

namespace Project\Models;

use \Core\Model;

class Theme extends Model
{
    public function getTopicName($id)
    {
    //    return $this->findOne("SELECT * FROM themes WHERE id=$id");
    return $this->findOneBind("SELECT * FROM themes WHERE id=?", "s", [$id]);

    }
    public function getComments($id)
    {
        return $this->findMany("SELECT * FROM comments WHERE theme_is=$id AND delete_flag=0 AND parrent_id IS NULL ORDER BY date DESC LIMIT 10");
    }
    public function getParrentComment($id)
    {
        return $this->findMany("SELECT * FROM comments WHERE parrent_id=$id AND delete_flag=0 ORDER BY date DESC");
    }
    public function deleteComment($id)
    {
        return $this->delete("UPDATE comments SET delete_flag=1 WHERE id = $id");
    }
    public function deleteChildComment($id)
    {

        return $this->delete("UPDATE comments SET delete_flag=1 WHERE parrent_id = $id");
    }
    public function getUserName($id)
    {
        return $this->findOne("SELECT login FROM users WHERE id=$id");
    }
    public function test($text)
    {
        return $this->insert("INSERT INTO tet SET id=\"$text\"");
    }
    public function setComment($topicId, $userId, $text, $parrentId = 'NULL')
    {
        $this->insert("INSERT INTO comments SET theme_is=$topicId, user_id=$userId, date=NOW(), text=\"$text\", parrent_id=$parrentId");
        return $this->getComment(mysqli_insert_id($this->getLink()));
    }
    public function getComment($id)
    {
        return $this->findOne("SELECT * FROM comments WHERE id=$id");
    }
}
