<?php

namespace Components;

class Session
{
    public static $session;

    private $isStarted = false;

    public static function getSession()
    {
        if (!self::$session) {
            self::$session = new self;
        }

        self::$session->start();

        return self::$session;
    }

    public function __call($method, $parameters)
    {
        $name = strtolower(substr($method, 3));
        if (!strncasecmp($method, 'get', 3)) {
            if (isset($_SESSION[$name])) {
                return $_SESSION[$name];
            }
        }
        if (!strncasecmp($method, 'set', 3)) {
            $_SESSION[$name] = $parameters[0];
        }
    }

    public function start()
    {
        if (!$this->isStarted) {
            session_start();
            $this->isStarted = true;
        }
    }

    public function destroy()
    {
        if ($this->isStarted) {
            session_destroy();
            unset($_SESSION);
            $this->isStarted = false;
        }
    }
}