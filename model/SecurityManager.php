<?php
/*class CommentManager*/
namespace Models;


class SecurityManager extends Manager
{
    public function verifyUser($login)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM `users` WHERE (username = :login OR email = :login)');
        $req->execute(array(
            'login'=>$login,


        ));
        return $req->fetch();



    }

    public function addUser($email,$username,$password)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO `users` (email, username, password) VALUES (:email, :username, :password);');
        $req->execute(array(
            'email' => $email,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]),

        ));

    }


}