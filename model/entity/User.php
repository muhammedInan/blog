<?php
/**
 * Created by PhpStorm.
 * User: WIN10
 * Date: 14/07/2018
 * Time: 17:08
 */

namespace Models\entity;

/**
 * Class User
 * @package Models\entity
 * class represent for sign in a blog for become users or admin for have privileged publied a blog
 */
class User
{
    protected $id;
    protected $username;
    protected $password;
    protected $email;
    protected $role;

    /**
     * Comment constructor.
     * @param array $valeurs
     * @param $valeurs array values for assigned
     * construc of the class who assigned data specified in parameters from atribut correspond
     */
    public function __construct($valeurs = [])
    {
        //if specified the values then we hydrate object
        if (!empty($valeurs)) {
            $this->hydrate($valeurs);

        }
    }

    /**
     * method assigned the values specified from correspond attributs
     * @param $donnees array Les données à assigner
     * @return void
     */
    public function hydrate($donnees)
    {
        foreach ($donnees as $attribut => $valeur) {
            $methode = 'set' . ucfirst($attribut);

            if (is_callable([$this, $methode])) {
                $this->$methode($valeur);
            }
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = (int)$id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)


    {
        $this->username = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    // GETTERS //

    public function setPassword($password)


    {
        $this->password = $password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }
}