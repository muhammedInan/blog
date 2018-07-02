<?php



namespace Controllers;


class SecurityController extends Controller
{
    public function login()

    {
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            sleep(1); // Prévention brut force
            $securityManager = new \Models\SecurityManager();
            $user =  $securityManager->verifyUser($_POST['login']);

            if (password_verify($_POST['password'], $user['password'])) {
                $session = $this->getSession();
                $session->setUser($user);
                $this->addFlash('success','vous êtes bien authentifier');



                return $this->generateUrlRedirection('security', 'profile');


            }
            $this->addFlash('danger','votre mot de passe  ou votre login sont  incorrect' );
        }

        return $this->render('security/login.html.twig', array(
            'token' => $this->generateToken(),
        ));
    }

    public function register()
    {
        if ('POST' === $_SERVER['REQUEST_METHOD'] && $this->verifyToken($_POST['token'])) {
            $securityManager = new \Models\SecurityManager();
            $securityManager->addUser($_POST['email'], $_POST['username'], $_POST['password']);

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
     */
    public function profile()
    {

        $session = $this->getSession();
        if ($session->getUser() !== null )
            return $this->render('security/profile.html.twig', array(
            'user' => $this->getUser(),
            ));

        else
            return $this->render('404.html.twig');

    }

    public function logout()
    {
        $session = $this->getSession();
        $session->destroy();
        return $this->generateUrlRedirection('security', 'login');
    }





}