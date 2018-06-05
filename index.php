<?php



require_once 'vendor/autoload.php';

use Controllers\Controller;
/* get c = le controller , get t = fonction */
if (isset($_GET['c']) && isset($_GET['t'])) {
    $class = 'Controllers\\'.ucfirst($_GET['c']).'Controller';
    $target = $_GET['t'];

    $post = (isset($_POST['params'])) ? $_POST['params'] : array();
    $get = (isset($_GET['params'])) ? $_GET['params'] : array();
    $params = array_merge($get, $post);

    if (class_exists($class, true)) {
        $class = new $class();
        if (in_array($target, get_class_methods($class))) {
            call_user_func_array([$class, $target], $params);
            exit();
        }
    }


    $controller = new Controller();
   // $controller->twig->render('error/404.html.twig');
    echo '404';
}
else
{
    $class = 'Controllers\\DefaultController';
    $target = 'home';



    if (class_exists($class, true)) {
        $class = new $class();
        if (in_array($target, get_class_methods($class))) {
            call_user_func_array([$class, $target],array());
            exit();
        }
    }
}