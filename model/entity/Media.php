<?php
/**
 * Created by PhpStorm.
 * User: WIN10
 * Date: 14/07/2018
 * Time: 17:17
 */

namespace Models\entity;

/**
 * Class Media
 * @package Models\entity
 */
class Media
{
    protected $id,
        $name,
        $file,
        $postId,
        $type;

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

    // SETTERS //

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setFile($file)
    {
        $this->file = $file;
    }

    public function setPostId($postId)
    {
        $this->postId = $postId;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getId()
    {
        return $this->id;
    }

    // GETTERS //

    public function setId($id)
    {
        $this->id = (int)$id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function getPostId()
    {
        return $this->postId;
    }

    public function getType()
    {
        return $this->type;
    }
}

