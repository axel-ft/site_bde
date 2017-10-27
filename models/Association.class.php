<?php namespace Model;

require_once('DataBaseAccess.class.php');

/**
 * Association model class which contains all requests to the database to manage the associations
 *
 * @author Axel Floquet-Trillot
 * @link https://axelfloquet.fr
 */
class Association {

    private $DB;

    public function __construct()
    {
        $DB = DataBaseAccess::getInstance();
    }

    /**
     * Creates a new association
     *
     */
    public function NewAssociation()
    {
        $Association = $DB->prepare('INSERT INTO associations(name_asso, acronym, description_asso, logo, email, phone, facebook_link, twitter_link, id_contact)
                                 VALUES (:name_asso, :acronym, :description_asso, :logo, :email, :phone, :facebook_link, :twitter_link, :id_contact');
        $Association->bindParam(':name_asso',           $_POST['name_asso'],            PDO::PARAM_STR);
        $Association->bindParam(':acronym',             $_POST['acronym'],              PDO::PARAM_STR);
        $Association->bindParam(':description_asso',    $_POST['description_asso'],     PDO::PARAM_STR);
        $Association->bindParam(':logo',                $_POST['logo'],                 PDO::PARAM_STR);
        $Association->bindParam(':email',               $_POST['email'],                PDO::PARAM_STR);
        $Association->bindParam(':phone',               $_POST['phone'],                PDO::PARAM_STR);
        $Association->bindParam(':facebook_link',       $_POST['facebook_link'],        PDO::PARAM_STR);
        $Association->bindParam(':twitter_link',        $_POST['twitter_link'],         PDO::PARAM_STR);
        $Association->bindParam(':id_contact',          intval($_POST['id_contact']),   PDO::PARAM_INT);
        $Association->execute();
    }

    /**
     * Updates a existing association
     *
     */
    public function UpdateAssociation($ID)
    {
        $UpdateAsso = $DB->prepare('UPDATE associations SET name_asso = :name_asso, acronym = :acronym, description_asso = :descritption_asso, logo = :logo, email = :email, phone = :phone, facebook_link = :facebook_link, twitter_link = :twitter_link, id_contact = :id_contact WHERE id_asso = :id_asso');
        $UpdateAsso->bindParam(':id_asso',             intval($ID),                    PDO::PARAM_STR);
        $UpdateAsso->bindParam(':name_asso',           $_POST['name_asso'],            PDO::PARAM_STR);
        $UpdateAsso->bindParam(':acronym',             $_POST['acronym'],              PDO::PARAM_STR);
        $UpdateAsso->bindParam(':description_asso',    $_POST['description_asso'],     PDO::PARAM_STR);
        $UpdateAsso->bindParam(':logo',                $_POST['logo'],                 PDO::PARAM_STR);
        $UpdateAsso->bindParam(':email',               $_POST['email'],                PDO::PARAM_STR);
        $UpdateAsso->bindParam(':phone',               $_POST['phone'],                PDO::PARAM_STR);
        $UpdateAsso->bindParam(':facebook_link',       $_POST['facebook_link'],        PDO::PARAM_STR);
        $UpdateAsso->bindParam(':twitter_link',        $_POST['twitter_link'],         PDO::PARAM_STR);
        $UpdateAsso->bindParam(':id_contact',          intval($_POST['id_contact']),   PDO::PARAM_INT);
        $UpdateAsso->execute();
    }

    /**
     * Get one association if ID is given or all associations
     *
     * @param int ID
     *
     * @return Array[mixed]
     */
    public function GetAssociation($ID = null) {
        if ($ID !== null) {
            $GetAsso = $DB->prepare('SELECT * FROM associations WHERE id_asso = :id_asso');
            $GetAsso->bindParam(':id_asso', intval($ID), PDO::PARAM_INT);
            $GetAsso->execute();
            $Asso = $GetAsso->fetchAll();
            return (count($Asso) > 0) ? $Asso : null;
        } else {
            $GetAssos = $DB->prepare('SELECT * FROM associations');
            $GetAssos->execute();
            $Assos = $GetAssos->fetchAll();
            return (count($Assos) > 0) ? $Assos : null;;
        }
    }

    public function DeleteAssociation($ID)
    {
        if ($ID !== null)
        {
            $DelAsso = $DB->prepare('DELETE FROM associations WHERE id_asso = :id_asso');
            $DelAsso->bindParam('id_asso', intval($ID), PDO::PARAM_INT);
            $DelAsso->execute();
        }
    }


}
