<?php
namespace Models;

use Models\Entity\Post;
class PostManager extends Database
{
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT posts.id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, 
                                      username
                                     FROM posts INNER JOIN users ON user_id = users.id ORDER BY creation_date ');
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Post::class);
        $posts = $req->fetchAll();


       /* while ($post = $req->fetch()){
           $postline = ['id' => $post->id,
               'title' => $post['title'],
               'content' =>$post['content'],
               'creationDate' =>$post['creation_date_fr']];
           $userline = ['username' => $post['username']];

           $user = new User ($userline);
           $post = new Post ($postline);
           $post ->setUser($user);
           $posts[] = $post;


        }*/


        return $posts;

    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, user_id FROM posts WHERE id = ?');


       $req->execute(array($postId));
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Post::class);
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
            $post->getUser()->getId(),
        ));
    }



    public function deletePost(Post $post)
    {
        $db = $this->dbConnect();
        $req = $db->prepare(' DELETE FROM posts WHERE id = :post_id AND user_id = :user_id ');
        $req->execute(array(
            $post -> getId() ,
            $post ->getUser()->getId(),
            ));

    }

    public function updatePost(Post $post)
    {
        $db = $this->dbConnect();
        $req = $db->prepare(' UPDATE posts set title = :title , content = :content WHERE id = :post_id');
        $req->execute(array(
            $post -> getTitle(),
            $post -> getContent(),
            $post ->getUserId()->getId(),
        ) );

    }





   
}