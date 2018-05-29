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

class Controller
{
    protected $twig;

    function __construct()
    {
        // Twig Configuration
        $loader = new Twig_Loader_Filesystem('./view/');
        $this->twig = new Twig_Environment($loader, array(
            'cache' => false,
        ));

        //
    }
    public function getSession()
    {
        return Session::getSession();
    }

    public function getUser()
    {
        return $this->getSession()->getUser();
    }

    public function generateUrlRedirection(string $controller, string $method, array $getParameters = array())
    {
        $url = 'index.php?c='.$controller.'&t='.$method;
        foreach ($getParameters as $key => $value) {
            $url .= '&params['.$key.']='.$value;
        }
        header('Location: '.$url);
        exit();
    }

    public function generateToken()
    {
        $token = bin2hex(random_bytes(32));
        $this->getSession()->setToken($token);
        return $token;
    }

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
