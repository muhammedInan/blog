<?php
/**
 * Created by PhpStorm.
 * User: WIN10
 * Date: 20/05/2018
 * Time: 16:52
 */

namespace Controllers;

class CommentController extends Controller
{
    function addComment($postId )
    {

        if (!empty($_POST['content'])) {


            $commentManager = new \Models\CommentManager();

             $commentManager->postComment($postId, 1, $_POST['content']);
        }

            echo $this->twig->render('comment/add.html.twig');

    }
}