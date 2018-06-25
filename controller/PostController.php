<?php


namespace Controllers;

/* the class PostController it's concerned the part post*/

class PostController extends Controller
{
   /** function listPosts it's for display all the post */
    public function listPosts()
    {
         $postManager = new \Models\PostManager();

        $posts = $postManager->getPosts(); //  function call o this object



         echo $this->twig->render('post/listPosts.html.twig', array(
           'posts' => $posts,
           ));

    }

    public function addPost()
    {

        $session = $this->getSession();
        $user = $session->getUser();
        if ($user !== null ) {
            if ('POST' === $_SERVER['REQUEST_METHOD']) {
                $postManager = new \Models\PostManager();
                $postManager->addPost($_POST['title'], $_POST['content'],$user['id'] );

            }

            echo $this->twig->render('post/addpost.html.twig', array(
                'user' => $this->getUser(),
            ));
        }
        else {
            echo $this->twig->render('error/403.html.twig');
        }
    }

    /**function deletePost it's for delete a post */
   public function deletePost($postId)
   {
       $postManager = new \Models\PostManager();

       if (!empty($postId)) {

           $postManager->deletePost($postId);
       }
       $session = $this->getSession();
       if ($session->getUser() !== null )
           echo $this->twig->render('security/profile.html.twig', array(
               'user' => $this->getUser(),
           ));

       else
           echo $this->twig->render('404.html.twig');



   }

   public function updatePost($postId)
{
    $postManager = new \Models\PostManager();

    if (!empty($postId)) {

        $postManager->updatePost($postId);
    }
    $session = $this->getSession();
    if ($session->getUser() !== null )
        echo $this->twig->render('security/profile.html.twig', array(
            'user' => $this->getUser(),
        ));

    else
        echo $this->twig->render('404.html.twig');

}
/** this function allows display  update post , add post , and comment */
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


