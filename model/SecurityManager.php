<?php

namespace Models;

use Models\Entity\User;

/**
 * Class SecurityManager
 * @package Models
 * class represent security in the blog for recovered data in the class parents database
 */
class SecurityManager extends Database
{
    /**
     * @param $login
     * @return mixed
     * function for verify the data of users
     */
    public function verifyUser($login)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM `user` WHERE (username = :login OR email = :login)');
        $req->execute(array(
            'login' => $login,
        ));
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, User::class);
        return $req->fetch();
    }

    /**
     * @param User $user
     * function for create a new users called by the method register in securiy Controller
     */
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