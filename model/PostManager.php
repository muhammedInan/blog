<?php
namespace Models;


class PostManager extends Manager
{
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');
        $posts = $req->fetchAll(\PDO::FETCH_ASSOC);

        return $posts;

    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch(\PDO::FETCH_ASSOC);

        return $post;
    }

    public function addPost($title, $content, $userId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare(' INSERT INTO `posts`(`title`, `content`, `creation_date`, `user_id`) VALUES ( ?, ?,NOW(),?) ');
        $req->execute(array( $title, $content, $userId));
    }



    public function deletePost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare(' DELETE FROM comments WHERE post_id = :post_id; DELETE FROM posts WHERE id = :post_id');
        $req->execute(array('post_id' => $postId) );


    }

    public function updatePost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare(' UPDATE posts set id = ? WHERE id = :post_id');
        $req->execute(array('post_id' => $postId) );
    }





   
}