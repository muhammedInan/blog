<?php

namespace Components;

class Session
{
    public static $session;

    private $isStarted = false;
//récuperer la session active ,
    public static function getSession()
    {
        //on instancie 1 seul session pour toute l'application
        if (!self::$session) {
            self::$session = new self;
        }
// on demarre la session
        self::$session->start();

        return self::$session;
    }
//construct fot method ant parameters
//on genere les geters et les setters
//$session->getId();
//$session->setUser($user);


    public function __call($method, $parameters)
    {
        //retire les 3 premier caracteres de $method , strolower = minuscule
        $name = strtolower(substr($method, 3));
        // on verifie si $method commence par get
        if (!strncasecmp($method, 'get', 3)) {
            // on verifie sdans la variable session si id existe
            if (isset($_SESSION[$name])) {
                return $_SESSION[$name];
            }
        }
        if (!strncasecmp($method, 'set', 3)) {
            $_SESSION[$name] = $parameters[0];
        }
    }
// for start a session
    public function start()
    {
        if (!$this->isStarted) {
            session_start();
            $this->isStarted = true;
        }
    }
// function for exit session logout
    public function destroy()
    {
        if ($this->isStarted) {
            session_destroy();
            unset($_SESSION);
            $this->isStarted = false;
        }
    }
}