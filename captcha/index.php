<?php
session_start();

if(isset($_POST['captcha'])){
    if($_POST['captcha'] == $_SESSION['captcha']) {
        echo "Captcha valide ! ";
    } else {
        echo "Captcha invalide...";

    }
}


