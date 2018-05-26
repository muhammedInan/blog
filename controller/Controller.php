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
}