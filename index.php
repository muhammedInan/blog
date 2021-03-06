<?php

require_once 'vendor/autoload.php';

use Controllers\Controller;

/* get c = le controller , get t = fonction */
// we verify url in controller and fucntion
if (isset($_GET['c']) && isset($_GET['t'])) {
    $class = 'Controllers\\' . ucfirst($_GET['c']) . 'Controller';
    $target = $_GET['t'];
    $params = (isset($_GET['params'])) ? $_GET['params'] : array();

    if (class_exists($class, true)) {
        $class = new $class();
        if (in_array($target, get_class_methods($class))) {
            call_user_func_array([$class, $target], $params);
            exit();
        }
    }

    $controller = new Controller();

    echo '404';
} else {
    $class = 'Controllers\\DefaultController';
    $target = 'home';
    $params = (isset($_GET['params'])) ? $_GET['params'] : array();

    if (class_exists($class, true)) {
        $class = new $class();
        if (in_array($target, get_class_methods($class))) {
            call_user_func_array([$class, $target], $params);
            exit();
        }
    }
}
