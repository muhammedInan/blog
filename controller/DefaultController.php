<?php

namespace Controllers;

/**
 * defaultController
 * User: WIN10
 * Date: 04/06/2018
 * Time: 15:42
 */
class DefaultController extends Controller

{

    /**
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function home()
    {
        echo $this->twig->render('index.html.twig');
    }
}

