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
class Comment
{
    protected $id;
    protected $postId;
    protected $author;
    protected $comment;
    protected $commentDate;
    protected $published;

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

    public function getPostId()
    {
        return $this->postId;
    }

    public function setPostId($postId)


    {
        $this->postId = $postId;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }


    // GETTERS //

    public function getCommentDate()
    {
        return $this->commentDate;
    }

    public function setCommentDate($commentDate)
    {
        $this->commentDate = $commentDate;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function getPublished()
    {
        return $this->published;
    }

    public function setPublished($published)
    {
        $this->published = $published;
    }


}
