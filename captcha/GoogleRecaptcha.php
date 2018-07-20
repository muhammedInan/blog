
<?php

//  my private keys
$secret = "	6Lfzy2IUAAAAAGWYz1RCO5MBN1VyufaV66aHgRvj";
//  parameters resend by the recaptcha
$response = $_POST['g-recaptcha-response'];
// recover IP of user
$remoteip = $_SERVER['REMOTE_ADDR'];

$api_url = "https://www.google.com/recaptcha/api/siteverify?secret="
    . $secret
    . "&response=" . $response
    . "&remoteip=" . $remoteip ;

$decode = json_decode(file_get_contents($api_url), true);

if ($decode['success'] == true) {
    echo "c'est un humain";
}

else {

    echo " c'es un robot ";
}
