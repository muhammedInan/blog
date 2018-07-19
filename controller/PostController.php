<?php


namespace Controllers;
use Components\Session;
use Models\Entity\Post;
use Models\PostManager;
use Models\Entity\Comment;
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
$post =  new Post ($_POST);
$post -> setUser($user);



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

       $session = $this->getSession();
       if ($session->getUser() !== null)

       $postManager = new PostManager();
       {
       if (!empty ($postId)) {
           if ('GET' === $_SERVER['REQUEST_METHOD'] && $this->verifyToken($_POST['token'])) {


               $post = new Post([
                   'id' => $_POST['id'],
                   'user' => $session ->getUser(),


               ]);

               $postManager->deletePost($post);
           }


           return $this->render('security/profile.html.twig', array(
               'user' => $this->getUser(),

           ));
       }
       else
           return $this->render('404.html.twig');
       }

       }




   public function updatePost($postId)
{

    $user = $this->getUser();
    $postManager = new PostManager();
    $post = $postManager->getPost($postId);

    if ($user->id == $post->user_id ) {
        if ('POST' === $_SERVER['REQUEST_METHOD'] && $this->verifyToken($_POST['token']))  {
            $post = new Post([
                'title' =>$_POST['title'],
                'content' =>$_POST['content'],
                'userId' => $user->id,

            ]);


            $postManager->updatePost($post);



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

       $user = $this->getUser();
       $postManager = new PostManager();
       $post = $postManager->getPost($postId);
       $commentManager = new \Models\CommentManager();

       if ('POST' === $_SERVER['REQUEST_METHOD'] && $this->verifyToken($_POST['token']))  {

           $comment = new Comment([
               'postId' => $postId,
               'author' => $user->id,
               'comment' => $_POST['comment_content'],
               'published' => true,

           ]);




           $commentManager->postComment($comment);
           return $this->generateUrlRedirection('post', 'showPost',array(
               'postId'=> $postId,

           ));
       }
       $comments = $commentManager->getComments($postId);
        return $this->render('post/show.html.twig', array(
            'post' => $post,
            'comments' =>$comments,
            'token' => $this->generateToken(),
   ));
   }
}


