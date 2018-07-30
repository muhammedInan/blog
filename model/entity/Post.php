<?php
/**
 * Created by PhpStorm.
 * User: WIN10
 * Date: 09/07/2018
 * Time: 15:35
 */

namespace Models\Entity;


class Post
{
    protected $id;
    protected $title;
    protected $content;
    protected $creationDate;
    protected $user;


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

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        if (!is_string($title) || empty($title)) {
            $this->erreurs[] = self::AUTEUR_INVALIDE;
        } else {
            $this->title = $title;
        }
    }

    public function getContent()
    {
        return $this->content;
    }

    // GETTERS //

    public function setContent($content)
    {
        if (!is_string($content) || empty($content)) {
            $this->erreurs[] = self::CONTENU_INVALIDE;
        } else {
            $this->content = $content;
        }
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTime $creationDate)
    {
        $this->creationDate = $creationDate;
    }

    public function getUser()
    {

        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }


}
