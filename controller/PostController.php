<?php


namespace Controllers;

use Components\Session;
use Models\Entity\Post;
use Models\PostManager;
use Models\Entity\Comment;

/**
 * Class PostController
 * @package Controllers
 * the class PostController it's concerned the part post*
 */
class PostController extends Controller
{
    /** function listPosts it's for display all the post */
    public function listPosts()
    {
        $postManager = new PostManager(); // create a new object
        $posts = $postManager->getPosts(); //  function call o this object
        return $this->render('post/listPosts.html.twig', array(
            'posts' => $posts,
        ));

    }

    /**
     *this function allows of user add the post if it connected in session
     */
    public function addPost()
    {
        $session = Session::getSession();
        $user = $this->getUser();//utilisateur connecté
        $postManager = new PostManager();// create new object
        if (isset ($user)) {
            if ('POST' === $_SERVER['REQUEST_METHOD'] && $this->verifyToken($_POST['token'])) {  // it load 'post' and get so 2 times after this it enter in condition
                $post = new Post ($_POST);// transfer object so create a new object
                $post->setUser($user);
                $postManager->addPost($post);
            }
            return $this->render('post/addpost.html.twig', array(
                'token' => $this->generateToken(),
            ));
        } else {
            return $this->render('error/403.html.twig');
        }
    }

    /**
     * function deletePost it's for delete a post
     * so it load get . after it enter in conidtion for create a new object array
     * because for respect function construct and hydrate in entity
     */
    public function deletePost($postId, $token)
    {
        $session = $this->getSession();
        if ($session->getUser() !== null)
            $postManager = new PostManager();
        {
            if (!empty ($postId)) {
                if ('GET' === $_SERVER['REQUEST_METHOD'] && $this->verifyToken($token)) {
                    $post = new Post([
                        'id' => $postId,
                        'user' => $session->getUser(),


                    ]);
                    $postManager->deletePost($post);
                }
                return $this->render('security/profile.html.twig', array(
                    'user' => $this->getUser(),

                ));
            } else
                return $this->render('404.html.twig');
        }
    }

    /**
     * @param $postId
     * function allows update a post but only user connected can did with only her post and no other post of other user
     * so we transfer object to views recupered by the model post mananager . else we returnss other page error 403
     */
    public function updatePost($postId)
    {
        $user = $this->getUser();
        $postManager = new PostManager();
        $post = $postManager->getPost($postId);
        if ($user->getId() == $post->getUser()->getId()) {
            if ('POST' === $_SERVER['REQUEST_METHOD'] && $this->verifyToken($_POST['token'])) {
                $post = new Post([
                    'title' => $_POST['title'],
                    'content' => $_POST['content'],
                    'userId' => $user->id,
                ]);
                $postManager->updatePost($post);
            }
            return $this->render('post/updatepost.html.twig', array(
                'post' => $post,
                'token' => $this->generateToken(),
            ));
        } else {
            return $this->render('error/403.html.twig');
        }
    }

    /** this function allows display  update post , add post , and comment
     * so it load get and post . after it enter in conidtion for create a new obkect array
     * because for respect function construct and hydrate in entity
     */
    public function showPost($postId)
    {
        $user = $this->getUser();
        $postManager = new PostManager();
        $post = $postManager->getPost($postId);
        $commentManager = new \Models\CommentManager();
        if ('POST' === $_SERVER['REQUEST_METHOD'] && $this->verifyToken($_POST['token'])) {
            $comment = new Comment([
                'postId' => $postId,
                'author' => $user->getId(),
                'comment' => $_POST['comment_content'],
                'published' => true,
            ]);
            $commentManager->postComment($comment);
            return $this->generateUrlRedirection('post', 'showPost', array(
                'postId' => $postId,
            ));
        }
        $comments = $commentManager->getComments($postId);
        return $this->render('post/show.html.twig', array(
            'post' => $post,
            'comments' => $comments,
            'token' => $this->generateToken(),
        ));
    }
}



