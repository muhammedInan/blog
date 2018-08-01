<?php
namespace Models;
use Models\Entity\Post;
use Models\Entity\User;
class PostManager extends Database
{
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT post.id, title, content, creation_date, 
                                      user_id,username,email,role 
                                     FROM post  INNER JOIN `user` ON user_id = `user`.id ORDER BY creation_date ');

        $posts = array();
       while ($post = $req->fetch()) {

           $postline = [
               'id' => $post->id,
               'title' => $post->title,
               'content' => $post->content,
               'creationDate' => new \DateTime($post->creation_date),
               ];
           $userline  = [
               'id' => $post->user_id,
               'username' =>$post->username,
               'email' =>$post->email,
               'role' =>$post->role,
               ];

          $user = new User ($userline);

           $poster = new Post ($postline);
           $poster-> setUser($user);

           $posts[] = $poster;


       }

        return $posts;

    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT post.id, title, content,   creation_date, user_id FROM post INNER JOIN `user` ON user_id = users.id  WHERE post.id = ?');
        $req->execute(array($postId));

        $post = $req->fetch();


            $postline = [
                'id' => $post->id,
                'title' => $post->title,
                'content' => $post->content,
                'creationDate' => new \DateTime($post->creation_date),
            ];
            $userline  = [
                'id' => $post->user_id,

            ];

            $user = new User ($userline);

            $poster = new Post ($postline);
            $poster-> setUser($user);



        return $poster;
    }

    public function addPost(Post $post)
    {

        $db = $this->dbConnect();
        $req = $db->prepare(' INSERT INTO `post`(`title`, `content`, `creation_date`, `user_id`) VALUES ( ?, ?,NOW(),?) ');
        $req->execute(array(
            $post->getTitle(),
            $post->getContent(),
            $post->getUser()->getId(),
        ));
    }



    public function deletePost(Post $post)
    {
        $db = $this->dbConnect();
        $req = $db->prepare(' DELETE FROM post WHERE id = ? AND user_id = ? ');
        $req->execute(array(
            $post -> getId() ,
            $post ->getUser()->getId()
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