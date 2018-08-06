<?php
/**
 * Created by PhpStorm.
 * User: WIN10
 * Date: 14/07/2018
 * Time: 17:01
 */

namespace Models\Entity;

/**
 * Class Comment
 * @package Models\Entity
 * class represent comment for that all the users could comment a post
 */
class Contact
{
    protected $id;
    protected $name;
    protected $email;
    protected $message;


    /**
     * Comment constructor.
     * @param array $valeurs
     * @param $valeurs array values for assigned
     * construc of the class who assigned data specified in parameters from atribut correspond
     */
    public function __construct($valeurs = [])
    {
        $valeurs['commentDate'] = date('Y-m-d');
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

    // SETTERS //

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = (int)$id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    // GETTERS //

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

}
