<?php
/**
 * Created by PhpStorm.
 * User: WIN10
 * Date: 05/08/2018
 * Time: 17:26
 */

namespace Models;

use Models\Entity\Contact;

/**
 * Class ContactManager
 * @package Models
 * class represent the part model for fetch and insert in the requete and
 * this parents ist Daabase for connection in localhost
 */
class ContactManager extends Database
{
    public function addContact(Contact $contact)
    {
        $db = $this->dbConnect();
        $req = $db->prepare(' INSERT INTO `contact`(`name`, `email`, `message`) VALUES ( ?, ?, ?) ');
        $req->execute(array(
            $contact->getName(),
            $contact->getEmail(),
            $contact->getMessage(),
        ));
    }

}