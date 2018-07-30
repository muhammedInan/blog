<?php
/*class CommentManager*/
namespace Models;
use Models\Entity\Comment;




class CommentManager extends Database
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));
        $comments->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Comment::class);
        $comments = $comments->fetchAll();

        return $comments;
    }


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