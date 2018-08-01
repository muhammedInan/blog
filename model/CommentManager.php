<?php
/*class CommentManager*/
namespace Models;
use Models\Entity\Comment;


/**
 * Class CommentManager
 * @package Models
 * class represent the part model for fetch and insert in the requete and
 * this parents ist Daabase for connection in localhost
 */
class CommentManager extends Database
{
    /**
     * @param $postId
     * @return array|bool|\PDOStatement
     *  this function is for fetch comment and called by showpost in section controller
     */
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comment WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));
        $comments->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Comment::class);
        $comments = $comments->fetchAll();

        return $comments;
    }

    /**
     * @param Comment $comment
     * @return bool
     * function for add comment in the post , we recovered object for transfer in controller  function showpost
     */
    public function postComment(Comment $comment)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO comment(post_id, author, comment, comment_date , published) VALUES(?, ?, ?, ?, ?)');
        $affectedLines = $req->execute(array(
            $comment -> getPostId(),
            $comment->getAuthor(),
            $comment->getComment(),
            $comment->getCommentDate(),
            $comment->getPublished(),
        ));


        return $affectedLines;
    }

    /**
     * @param $id
     * @param $valider
     * this function allows valid a comment by the users , it's called by the function valid comment in controller
     * we did a requete for valid so after valid we update published
     */
    public function confirmComment($id,$valider)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comment SET published = :valider WHERE id = :id'); //we valid the comments)
        $req->execute(array(
            'id'=> $id,
            'valider' => $valider,
        ));


    }






}