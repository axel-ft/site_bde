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
        $this->DB = DataBaseAccess::getInstance();
    }

    /**
     * Creates a new association
     *
     */
    public function NewAssociation(string $AssoName, string $Acronym = null, string $AssoDescription, string $Logo, string $Email = null, string $Phone = null, string $FacebookLink = null, string $TwitterLink = null)
    {
        $Association = $this->DB->prepare('INSERT INTO associations(name_asso, acronym, description_asso, logo, email, phone, facebook_link, twitter_link)
                                           VALUES (:name_asso, :acronym, :description_asso, :logo, :email, :phone, :facebook_link, :twitter_link)');
        $Association->bindParam(':name_asso',           $AssoName,        \PDO::PARAM_STR);
        $Association->bindParam(':acronym',             $Acronym,         \PDO::PARAM_STR);
        $Association->bindParam(':description_asso',    $AssoDescription, \PDO::PARAM_STR);
        $Association->bindParam(':logo',                $Logo,            \PDO::PARAM_STR);
        $Association->bindParam(':email',               $Email,           \PDO::PARAM_STR);
        $Association->bindParam(':phone',               $Phone,           \PDO::PARAM_STR);
        $Association->bindParam(':facebook_link',       $FacebookLink,    \PDO::PARAM_STR);
        $Association->bindParam(':twitter_link',        $TwitterLink,     \PDO::PARAM_STR);
        $Association->execute();

        $GetInsertedId = $this->DB->prepare('SELECT id_asso FROM associations WHERE name_asso = :name_asso');
        $GetInsertedId->bindParam(':name_asso', $AssoName, \PDO::PARAM_STR);
        $GetInsertedId->execute();
        $InsertedId = $GetInsertedId->fetchAll(\PDO::FETCH_ASSOC);
        return (count($InsertedId) > 0) ? $InsertedId[0]['id_asso'] : null;
    }

    /**
     * Updates a existing association
     *
     */
    public function UpdateAssociation(int $IdAsso, string $NameAsso, string $Acronym = null, string $DescriptionAsso, string $Logo, string $Email = null, string $Phone = null, string $FacebookLink = null, string $TwitterLink = null)
    {
        $UpdateAsso = $this->DB->prepare('UPDATE associations SET name_asso = :name_asso, acronym = :acronym, description_asso = :description_asso, logo = :logo, email = :email, phone = :phone, facebook_link = :facebook_link, twitter_link = :twitter_link WHERE id_asso = :id_asso');
        $UpdateAsso->bindParam(':id_asso',             $IdAsso,          \PDO::PARAM_INT);
        $UpdateAsso->bindParam(':name_asso',           $NameAsso,        \PDO::PARAM_STR);
        $UpdateAsso->bindParam(':acronym',             $Acronym,         \PDO::PARAM_STR);
        $UpdateAsso->bindParam(':description_asso',    $DescriptionAsso, \PDO::PARAM_STR);
        $UpdateAsso->bindParam(':logo',                $Logo,            \PDO::PARAM_STR);
        $UpdateAsso->bindParam(':email',               $Email,           \PDO::PARAM_STR);
        $UpdateAsso->bindParam(':phone',               $Phone,           \PDO::PARAM_STR);
        $UpdateAsso->bindParam(':facebook_link',       $FacebookLink,    \PDO::PARAM_STR);
        $UpdateAsso->bindParam(':twitter_link',        $TwitterLink,     \PDO::PARAM_STR);
        $UpdateAsso->execute();
    }

    /**
     * Get one association if ID is given or all associations
     *
     * @param int ID
     *
     * @return Array[mixed]
     */
    public function GetAssociation(int $ID = null) {
        if ($ID !== null) {
            $GetAsso = $this->DB->prepare('SELECT * FROM associations WHERE id_asso = :id_asso');
            $GetAsso->bindParam(':id_asso', $ID, \PDO::PARAM_INT);
            $GetAsso->execute();
            $Asso = $GetAsso->fetchAll();
            return (count($Asso) > 0) ? $Asso[0] : null;
        } else {
            $GetAssos = $this->DB->prepare('SELECT * FROM associations');
            $GetAssos->execute();
            $Assos = $GetAssos->fetchAll();
            return (count($Assos) > 0) ? $Assos : null;;
        }
    }

    public function DeleteAssociation(int $ID)
    {
        if (!is_null($ID))
        {
            $DelAsso = $this->DB->prepare('DELETE FROM associations WHERE id_asso = :id_asso');
            $DelAsso->bindParam('id_asso', $ID, \PDO::PARAM_INT);
            $DelAsso->execute();
        }
    }


}
