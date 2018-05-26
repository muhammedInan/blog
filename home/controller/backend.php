<?php

// Chargement des classes
require_once('model/PostAdmin.php');
require_once('model/CommentAdmin.php');

function listPosts()
{
    $postAdmin = new \OpenClassrooms\Blog\Model\PostAdmin();
    /*  $postManager = new PostManager();*/ // Création d'un objet
    $posts = $postAdmin->getPosts(); // Appel d'une fonction de cet objet

    require('view/backend/listPostsView.php');
}

function post()
{
    $postAdmin = new \OpenClassrooms\Blog\Model\PostAdmin();
    $commentAdmin = new \OpenClassrooms\Blog\Model\CommentAdmin();



    $post = $postAdmin->getPost($_GET['id']);
    $comments = $commentAdmin->getComments($_GET['id']);

    require('view/backend/postView.php');
}

function addPost($title, $content)
{
    $postsAdmin = new \OpenClassrooms\Blog\Model\PostAdmin();

    $affectedLines = $postsAdmin->postBlog(1, $title, $content);

     if ($affectedLines === false) {
         throw new Exception('Impossible d\'ajouter l\'article !');
     }
     else {
         header('Location: index.php?action=post&id=');
     }


}

function addComment($postId, $author, $comment)
{
    $commentAdmin = new \OpenClassrooms\Blog\Model\CommentAdmin();
    /* $commentAdmin = new CommentManager();*/

    $affectedLines = $commentAdmin->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}
