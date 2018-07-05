<?php


namespace Controllers;
use Components\Session;
/* the class PostController it's concerned the part post*/

class PostController extends Controller
{
   /** function listPosts it's for display all the post */
    public function listPosts()
    {
         $postManager = new \Models\PostManager();

        $posts = $postManager->getPosts(); //  function call o this object



         return $this->render('post/listPosts.html.twig', array(
           'posts' => $posts,
           ));

    }

    public function addPost()
    {

        $user = Session::getSession();
        $user = $this->getUser();
        $postManager = new \Models\PostManager();


        if (isset ($user) ) {
            if ('POST' === $_SERVER['REQUEST_METHOD'] && $this->verifyToken($_POST['token']))  {

                $postManager->addPost($_POST['title'], $_POST['content'],$user['id']);

            }

            return $this->render('post/addpost.html.twig', array(
                'token' => $this->generateToken(),
            ));
              //  $postManager->addPost($_POST['title'], $_POST['content'],$user['id'] );

          //  }

          //  return $this->render('post/addpost.html.twig', array(
              //  'user' => $this->getUser(),
          //  ));
        }
        else {
            return $this->render('error/403.html.twig');
        }
    }

    /**function deletePost it's for delete a post */
   public function deletePost($params)
   {
       print_r($params);
       $postManager = new \Models\PostManager();

       if ('GET' === $_SERVER['REQUEST_METHOD'] && $this->verifyToken($params['token'])) {
           if (!empty ($params['postId'])) {

               $postManager->deletePost($params['postId']);
           }
           $session = $this->getSession();
           if ($session->getUser() !== null)
               return $this->render('security/profile.html.twig', array(
                   'user' => $this->getUser(),

               ));

           else
               return $this->render('404.html.twig');

       }
   }



   public function updatePost($postId)
{

    $user = $this->getUser();
    $postManager = new \Models\PostManager();
    $post = $postManager->getPost($postId);

    if ($user['id'] == $post['user_id'] ) {
        if ('POST' === $_SERVER['REQUEST_METHOD'] && $this->verifyToken($_POST['token']))  {

            $postManager->updatePost($postId,$_POST['title'], $_POST['content'] );

        }

        return $this->render('post/updatepost.html.twig', array(
            'post' => $post,
            'token' => $this->generateToken(),
        ));
    }
    else {
        return $this->render('error/403.html.twig');
    }

}
/** this function allows display  update post , add post , and comment */
   public function showPost($postId)
   {
       $postManager = new \Models\PostManager();
       $post = $postManager->getPost($postId);
       $commentManager = new \Models\CommentManager();
       $comments = $commentManager->getComments($postId);

        return $this->render('post/show.html.twig', array(
       'post' => $post, 'comments' =>$comments,
            'token' => $this->generateToken(),
   ));
   }
}


