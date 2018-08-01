<?php

namespace Controllers;

use Models\Entity\User;
use Captcha\GoogleRecaptcha;

/**
 * Class SecurityController
 * @package Controllers
 * this class allows use the unction for security blog for sign , register of users
 * all the users must use this security for access security
 */
class SecurityController extends Controller
{
    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * function for login after register , so it verified if the data of users correspond with the function verify user in post manager
     * condition if for verify password and session , user with set , if the 3 correspond it's success . we used addFlash for confirmed the succes or failef
     */
    public function login()
    {
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            sleep(1);
            $securityManager = new \Models\SecurityManager();
            $user = $securityManager->verifyUser($_POST['login']);// retourne la valeur
            if (password_verify($_POST['password'], $user->getPassword())) {
                $session = $this->getSession();
                $session->setUser($user);
                $this->addFlash('success', 'vous êtes bien authentifier');
                return $this->generateUrlRedirection('security', 'profile');
            }
            $this->addFlash('danger', 'votre mot de passe  ou votre login sont  incorrect');
        }
        return $this->render('security/login.html.twig', array(
            'token' => $this->generateToken(),
        ));
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * this function is for register in the blog if it want become admin
     * so create a new object
     * verified if its methode post and verified if the token is send by the form is the same that session
     * we transfer the object a security manager with array function construct in entity
     */
    public function register()
    {
        $securityManager = new \Models\SecurityManager();
        if ('POST' === $_SERVER['REQUEST_METHOD'] //vérifié si on est en méthode post
            && $this->verifyToken($_POST['token'])) { // permet de vérifier si le token envoyer  par le formulaire est le meme que dans la session
            $user = new User([
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'email' => $_POST['email'],
                'role' => $_POST['role'],
            ]);
            $securityManager->addUser($user);
            return $this->generateUrlRedirection('security', 'login');
        }

        return $this->render('security/register.html.twig', array(
            'token' => $this->generateToken(),
        ));
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * function for user after connected so we verify with the $session
     */
    public function profile()
    {
        $session = $this->getSession();
        if ($session->getUser() !== null)
            return $this->render('security/profile.html.twig', array(
                'user' => $this->getUser(),
            ));
        else
            return $this->render('404.html.twig');
    }

    /**
     * function for quit the session profile after connexion
     */
    public function logout()
    {
        $session = $this->getSession();
        $session->destroy();
        return $this->generateUrlRedirection('security', 'login');
    }
}