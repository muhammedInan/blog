<?php
/**
 * Created by PhpStorm.
 * User: WIN10
 * Date: 14/07/2018
 * Time: 17:17
 */

namespace Models\entity;


class Media
{
  protected $id,
            $name,
            $file,
            $postId,
            $type,


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



   // SETTERS //

    public function setId($id)
    {
        $this->id = (int)$id;
    }

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

    // GETTERS //
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->postId;
    }

    public function getFile()
    {
        return $this->comment;
    }

    public function getPostId()
    {
        return $this->commentDate;
    }

    public function getType()
    {
        return $this->userId;
    }
}

}