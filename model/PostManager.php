<?php
namespace Models;

use Models\Entity\Post;
class PostManager extends Database
{
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');
        $posts = $req->fetchAll();

        return $posts;

    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, user_id FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    public function addPost(Post $post)
    {

        $db = $this->dbConnect();
        $req = $db->prepare(' INSERT INTO `posts`(`title`, `content`, `creation_date`, `user_id`) VALUES ( ?, ?,NOW(),?) ');
        $req->execute(array(
            $post->getTitle(),
            $post->getContent(),
            $post->getUserId(),
        ));
    }



    public function deletePost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare(' DELETE FROM comments WHERE post_id = :post_id; DELETE FROM posts WHERE id = :post_id');
        $req->execute(array('post_id' => $postId) );


    }

    public function updatePost($postId,$title,$content)
    {
        $db = $this->dbConnect();
        $req = $db->prepare(' UPDATE posts set title = :title , content = :content WHERE id = :post_id');
        $req->execute(array(
            'post_id' => $postId,
            'title' => $title,
            'content' =>$content,
        ) );

    }





   
}