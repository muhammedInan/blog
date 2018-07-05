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
     *function home for display home page and it send the file index for this
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function home()
    {
        return $this->render('index.html.twig');
    }


    public function contact()
    {
        return $this->render('contact.twig', ['name' => 'Marc', 'email' => 'demo@demo.fr']);
    }

}