<?php
/**
 * Created by PhpStorm.
 * User: WIN10
 * Date: 14/07/2018
 * Time: 17:08
 */

namespace Models\entity;


class User
{
    protected $id;
    protected $username;
    protected $password;
    protected $email;
    protected $role;


     public function __construct($valeurs = [])
     {
         //if specified the values then we hydrate object
         if (!empty($valeurs)) {
             $this->hydrate($valeurs);

         }
     }

       /**
        * Méthode assignant les valeurs spécifiées aux attributs correspondant.
        * @param $donnees array Les données à assigner
        * @return void
        */
  public function hydrate($donnees)
  {
      foreach ($donnees as $attribut => $valeur)
      {
          $methode = 'set'.ucfirst($attribut);

          if (is_callable([$this, $methode]))
          {
              $this->$methode($valeur);
          }
      }
  }

    public function setId($id)
    {
        $this->id = (int) $id;
    }

    public function setUsername($username)


        {
            $this->$username = $username;
        }




    public function setPassword($password)


        {
            $this->password = $password;
        }


    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    // GETTERS //
    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getRole()
    {
        return $this->role;
    }


}

}