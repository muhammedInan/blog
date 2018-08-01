<?php
/**
 * Created by PhpStorm.
 * User: WIN10
 * Date: 20/05/2018
 * Time: 16:52
 */

namespace Controllers;

/**
 * Class CommentController
 * @package Controllers
 * this class allows occupied the part Commment in the mvc only for valid a comment with function
 */
class CommentController extends Controller
{
    /**
     * @param $id
     * function validComment allows first all of recupered the variable user and compare with condition if user it's admin or not
     * it load , valid comment boolean . we recupered the data on model confrim commment with parameters id .
     * if ok we send the wiews valiid.html.twig else url redirection
     */
    function validComment($id)
    {
        $user = $this->getUser();
        if ($user) {
            if ($user->getRole() == 'ADMIN') {
                if ('POST' === $_SERVER['REQUEST_METHOD'] && $this->verifyToken($_POST['token'])) {
                    //  so we valid the comment corresponding
                    // we protected the "valid" variable for to avoid a error SQL
                    $_POST['validComment'] = (($_POST['validComment'] == 'on') ? true : false);
                    $commentManager = new \Models\CommentManager();
                    $commentManager->confirmComment($id, $_POST['validComment']);
                }
                return $this->render('comment/valid.html.twig', array(
                    'token' => $this->generateToken(),
                ));
            }
        } else {
            return $this->generateUrlRedirection('security', 'login');
        }
    }
}


