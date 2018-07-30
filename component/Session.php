<?php

namespace Components;
/**
 * Class Session
 * @package Components
 * class Session is for activ session for user and start and destroy after this the user quit the blog
 */
class Session
{
    public static $session;

    private $isStarted = false;



    /**
     * @return Session
     * recovered the activ session with get
     */
    public static function getSession()
    {

        // we instantiate only one session for all application
        if (!self::$session) {
            self::$session = new self;
        }

        // we start a session
        self::$session->start();

        return self::$session;
    }
//construct fot method ant parameters
//on genere les geters et les setters
//$session->getId();
//$session->setUser($user);


    /**
     * @param $method
     * @param $parameters
     * @return mixed
     * function who executed for every call object
     */
    public function __call($method, $parameters)
    {

        // we took of 3 first caracter of $method    strolower = minuscule
        $name = strtolower(substr($method, 3));

        //verified if $method begin by get
        if (!strncasecmp($method, 'get', 3)) {

            //verified in the variable session if id exist
            if (isset($_SESSION[$name])) {
                return $_SESSION[$name];
            }
        }
        if (!strncasecmp($method, 'set', 3)) {
            $_SESSION[$name] = $parameters[0];
        }
    }


    /**
     * for start a session
     */
    public function start()
    {
        if (!$this->isStarted) {
            session_start();
            $this->isStarted = true;
        }
    }


    /**
     * function for exit session logout
     */
    public function destroy()
    {
        if ($this->isStarted) {
            session_destroy();
            unset($_SESSION);
            $this->isStarted = false;
        }
    }
}