<?php
namespace Models;
use Models\Entity\Post;
use Models\Entity\User;

/**
 * Class PostManager
 * @package Models
 * this class is class children herited by database ,
 * it allows administrate the post for fetch post and called by the controller post
 * this is part model
 */
class PostManager extends Database
{

    /**
     * @return array
     * function for fetch all post called by the unction list post in postController and recupered the object in data
     */
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

    /**
     * @param $postId
     * @return Post
     * this function allows fetch one post after list post , the methid is same than getPosts
     */
    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT post.id, title, content, creation_date, user_id FROM post INNER JOIN `user` ON user_id = `user`.id  WHERE post.id = ?');
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

    /**
     * @param Post $post
     * this function is for add a post
     */
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


    /**
     * @param Post $post
     * function for delete a post used by the controller postController
     */
    public function deletePost(Post $post)
    {
        $db = $this->dbConnect();
        $req = $db->prepare(' DELETE FROM post WHERE id = ? AND user_id = ? ');
        $req->execute(array(
            $post -> getId() ,
            $post ->getUser()->getId()
            ));

    }

    /**
     * @param Post $post
     * function for update a post called by the function updatePost in postController
     */
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