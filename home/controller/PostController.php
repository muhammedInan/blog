<?php

// Chargement des classes
//require_once('model/PostManager.php');
//require_once('model/CommentManager.php');



namespace Controller;

class PostController extends Controller
{

    public function listPosts()
    {

        die('ok');
       // $postManager = new \Model\PostManager();
//
//        $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet
//
//var_dump($posts);

      // echo $this->twig->render('listPosts.html.twig', array(
         //   'posts' => $posts,
     //   ));



    }

//    function post()
//    {
//        $postManager = new \Model\PostManager();
//        $commentManager = new \Model\CommentManager();
//
//
//        $post = $postManager->getPost($_GET['id']);
//        $comments = $commentManager->getComments($_GET['id']);
//
//        require('view/frontend/postView.php');
//    }
//
//    function addComment($postId, $author, $comment)
//    {
//        $commentManager = new \Model\CommentManager();
//        /* $commentManager = new CommentManager();*/
//
//        $affectedLines = $commentManager->postComment($postId, $author, $comment);
//
//        if ($affectedLines === false) {
//            throw new Exception('Impossible d\'ajouter le commentaire !');
//        }
//        else {
//            header('Location: index.php?action=post&id=' . $postId);
//        }
//
//

}

