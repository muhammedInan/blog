<?php

namespace Controllers;

use Models\Entity\Contact;
use Models\ContactManager;
/**
 * defaultController
 * User: WIN10
 * Date: 04/06/2018
 * Time: 15:42
 * this class allows be call if the condition the others class not correspond for home and contact
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

    /**
     * method for fill array compared example
     */
    public function contact()
    {
        if ('POST' === $_SERVER['REQUEST_METHOD'] && $this->verifyToken($_POST['token'])) {

            $contact = new Contact([
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'message' => $_POST['message'],
            ]);// transfer object so create a new object
            $contactManager = new ContactManager();
            $contactManager->addContact($contact);
        }

        return $this->render('contact.html.twig', [
            'token' => $this->generateToken(), //enregistrer un token dans variabel session pour identifier luser qui a demander le formulaire
        ]);
    }
}
