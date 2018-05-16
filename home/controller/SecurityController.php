<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function ()
{

    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    /*  $postManager = new PostManager();*/ // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

    require('view/frontend/listPostsView.php');
}

