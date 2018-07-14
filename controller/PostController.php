<?php


namespace Controllers;
use Components\Session;
use Models\Entity\Post;
use Models\PostManager;
/* the class PostController it's concerned the part post*/

class PostController extends Controller
{
   /** function listPosts it's for display all the post */
    public function listPosts()
    {
         $postManager = new PostManager();

        $posts = $postManager->getPosts(); //  function call o this object



         return $this->render('post/listPosts.html.twig', array(
           'posts' => $posts,
           ));

    }

    public function addPost()
    {

       $session = Session::getSession();
        $user = $this->getUser();//utilisateur connecté
        $postManager = new PostManager();


        if (isset ($user) ) {
            if ('POST' === $_SERVER['REQUEST_METHOD'] && $this->verifyToken($_POST['token']))  {
            $post = new Post([
                'title' =>$_POST['title'],
                'content' =>$_POST['content'],
                'userId' => $user->id,

            ]);


                $postManager->addPost($post);

            }

            return $this->render('post/addpost.html.twig', array(
                'token' => $this->generateToken(),
            ));

        }
        else {
            return $this->render('error/403.html.twig');
        }
    }

    /**function deletePost it's for delete a post */
   public function deletePost($postId,$token)
   {

       $postManager = new PostManager();

       if ('GET' === $_SERVER['REQUEST_METHOD'] && $this->verifyToken($token)) {
           if (!empty ($postId)) {

               $postManager->deletePost($postId);
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



   public function updatePost($postId,$token=null,$title=null,$content=null)
{

    $user = $this->getUser();
    $postManager = new PostManager();
    $post = $postManager->getPost($postId);

    if ($user->id == $post->user_id ) {
        if ('POST' === $_SERVER['REQUEST_METHOD'] && $this->verifyToken($token))  {
            var_dump($post);

            $postManager->updatePost($postId,$title,$content );

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
   public function showPost($postId,$author,$comment_content=null,$token=null)
   {
       $user = $this->getUser();
       $postManager = new PostManager();
       $post = $postManager->getPost($postId);
       $commentManager = new \Models\CommentManager();
       $comments = $commentManager->getComments($postId);
       if (!empty($comment_content)) {


           $commentManager = new \Models\CommentManager();

           $commentManager->postComment($postId,$user,$author,$comment_content);
           return $this->generateUrlRedirection('post', 'showPost',array(
               'postId'=> $postId,

           ));
       }
        return $this->render('post/show.html.twig', array(
       'post' => $post, 'comments' =>$comments,
            'token' => $this->generateToken(),
   ));
   }
}


