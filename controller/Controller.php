<?php
/**
 * Created by PhpStorm.
 * User: WIN10
 * Date: 19/05/2018
 * Time: 19:22
 */

namespace Controllers;

use \Twig_Loader_Filesystem;
use \Twig_Environment;
use Components\Session;

/**
 * Class Controller
 * @package Controllers
 * The controller will be responsible for returning views with data or without data.
 * At the top of the file are conditions that allow to call the method that corresponds to the action in parameter.
 *The class controller contains the methods to call according to the action.
 */
class Controller
{
    public function clearflash()
    {
        $this->getSession()->setFlash(null);
    }

    /**
     * @param $view
     * @param array $parameters
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *this function allows load the file view correspond in the unction controller
     */
    public function render($view, $parameters = array())
    {
        // Twig Configuration
        $loader = new Twig_Loader_Filesystem('./view/');// twig ask where is the twig views
        $content = new Twig_Environment($loader, array(
            'cache' => false,
        ));
        $parameters['connected_user'] = $this->getUser();//  recovered in the views the users connected
        $flash = $this->getSession()->getFlash();
        if ($flash && $flash['status'] == false) {

            $parameters['flash'] = $flash;
            $flash['status'] = true;//elle a etait vue
            $this->getSession()->setFlash($flash);
        }
        //
        echo $content->render($view, $parameters);
    }

    /**
     * @return Session
     * throws session
     * recovered the attribute values and implements method
     */
    public function getSession()
    {
        return Session::getSession();
    }
//permet de recuperer lutilisateur connecte

    /**
     * @return mixed
     * allows recovered user connected
     */
    public function getUser()
    {
        return $this->getSession()->getUser();
    }

    /**
     * @param $code
     * @param $message
     * @param bool $status
     * @return bool
     * this function is for fetch a message after connexion success or failed for confirmed the user
     */
    public function addFlash($code, $message, $status = false)
    {
        $flash = array(
            'code' => $code,
            'message' => $message,
            'status' => $status,
        );
        if ($this->getSession()->setFlash($flash)) {

            return true;
        } else
            return false;
    }

    /**
     * @param string $controller
     * @param string $method
     * @param array $getParameters
     * used for call views
     */
    public function generateUrlRedirection(string $controller, string $method, array $getParameters = array())
    {
        $url = 'index.php?c=' . $controller . '&t=' . $method;
        foreach ($getParameters as $key => $value) {
            $url .= '&params[' . $key . ']=' . $value;
        }
        header('Location: ' . $url);
        exit();
    }

    /**
     * @return string
     * @throws \Exception
     * this function generate string pseudo random
     * we use get session
     */
    public function generateToken()
    {
        $token = bin2hex(random_bytes(32));
        $this->getSession()->setToken($token);
        return $token;
    }

    /**
     * @param $postToken
     * @return bool
     * this function allows verified i pseudo random it's same or not
     * for this we did condition for verified seesion token and post token
     */
    public function verifyToken($postToken)
    {
        $sessionToken = $this->getSession()->getToken();
        if (isset($sessionToken) AND isset($postToken) AND !empty($sessionToken) AND !empty($postToken)) {
            if ($sessionToken === $postToken) {
                return true;
            }
        }
        return false;
    }
}
