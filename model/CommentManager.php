<?php
/*class CommentManager*/
namespace Models;




class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));
        $comments = $comments->fetchAll(\PDO::FETCH_ASSOC);

        return $comments;
    }
    /*http://127.0.0.1/blog2/index.php?c=comment&t=addComment&params[postId]=2*/

    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $req->execute(array($postId, $author, $comment));


        return $affectedLines;
    }

    public function confirmComment($id, $valider)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE comments SET publication = :valider WHERE id = :id'); //On valide le commentaire)
        $req->execute(array(
            'id'=>$id,
            'valider' =>$valider
        ));


    }




}