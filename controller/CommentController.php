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

function validComment($id)
{
    if (isset($_POST['valider'])) // Si on demande de valider un commentaire
    {
        // Alors on valide le commentaire correspondant
        // On protège la variable "valider" pour éviter une faille SQL
        $_POST['valider'] = htmlspecialchars($_POST['valider']);
        $commentManager = new \Models\CommentManager();
        $commentManager->confirmComment($id , $_POST['valider']);


    }
    echo $this->twig->render(name: 'comment/valid.html.twig',array(
        'comment_id'=>$id,
));
}

