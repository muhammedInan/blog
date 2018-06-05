<?php


namespace Controllers;


class PostController extends Controller
{
    public function listPosts()
    {
         $postManager = new \Models\PostManager();

        $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet



         echo $this->twig->render('post/listPosts.html.twig', array(
           'posts' => $posts,
           ));

    }

   public function deletePost($postId)
   {
       $postManager = new \Models\PostManager();

       if (!empty($postId)) {

           $postManager->deletePost($postId);
       }

       //echo $this->twig->render('comment/add.html.twig');

   }

   public function updatePost($postId)
{
    $postManager = new \Models\PostManager();

    if (!empty($postId)) {

        $postManager->updatePost($postId);
    }

}

   public function showPost($postId)
   {
       $postManager = new \Models\PostManager();
       $post = $postManager->getPost($postId);
       $commentManager = new \Models\CommentManager();


       $comments = $commentManager->getComments($postId);

        echo $this->twig->render('post/show.html.twig', array(
       'post' => $post, 'comments' =>$comments
   ));
   }
}


