<?php
/*class CommentManager*/
namespace Models;
use Models\Entity\User;

class SecurityManager extends Database
{
    public function verifyUser($login)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM `user` WHERE (username = :login OR email = :login)');
        $req->execute(array(
            'login'=>$login,
        ));
        $req->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, User::class);
        return $req->fetch();



    }

    public function addUser(User $user)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO `user` (email, username, password) VALUES (:email, :username, :password);');
        $req->execute(array(
            $user->getUsername(),
            $user->getPassword(),
            $user->getEmail(),
            $user->getRole()

        ));

    }


}