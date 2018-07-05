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
    /**this function allows of add comment with params PostId*/
    function addComment($postId )
    {

        if (!empty($_POST['content'])) {


            $commentManager = new \Models\CommentManager();

             $commentManager->postComment($postId, 1, $_POST['content']);
        }

            return $this->render('comment/add.html.twig');

    }
}

function validComment($id)
{
    if (isset($_POST['valider'])) //if we request valid a comment
    {
        //  so we valid the comment corresponding
        // we protected the "valid" variable for to avoid a error SQL
        $_POST['valider'] = htmlspecialchars($_POST['valider']);
        $commentManager = new \Models\CommentManager();
        $commentManager->confirmComment($id , $_POST['valider']);


    }
    return $this->render( 'comment/valid.html.twig',array(
        'comment_id'=>$id,
));
}

