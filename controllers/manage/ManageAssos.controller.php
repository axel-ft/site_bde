<?php namespace Controller;

require_once "controllers/Common.controller.php";
require_once "models/Association.class.php";
require_once "models/User.class.php";

class ManageAssos extends CommonController
{
    private $AssociationsQueries;
    private $NameAsso,
            $Acronym,
            $AssoDescription,
            $Logo,
            $Email,
            $Phone,
            $FacebookLink,
            $TwitterLink,
            $ProfileID;

    public function __construct()
    {
        if (self::IsManager())
           throw new \Exception("Vous n'avez pas les droits suffisants pour accéder à cette page"); 

        $this->AssociationsQueries = new \Model\Association();
    }

    private function IsAssoFormComplete()
    {
        if ($IsAssoFormComplete = (self::AreFieldsPresent("name_asso", "description_asso", "logo", "profile")))
        {
            $this->NameAsso = self::ValidateStringField("name_asso");
            $this->Acronym = self::ValidateStringField("acronym");
            $this->AssoDescription = self::ValidateStringField("description_asso");
            $this->Logo = self::ValidateStringField("logo");
            $this->Email = self::ValidateStringField("email");
            $this->Phone = self::ValidateStringField("phone");
            $this->FacebookLink = self::ValidateStringField("facebook_link");
            $this->TwitterLink = self::ValidateStringField("twitter_link");
            $this->ProfileID = self::ValidateIntField("profile");
        }

        return $IsAssoFormComplete;
    }

    public function AddAsso()
    {
        if ($this->IsAssoFormComplete())
        {
            $this->AssociationsQueries->NewAssociation($this->NameAsso,
                                                       $this->Acronym,
                                                       $this->AssoDescription,
                                                       $this->Logo,
                                                       $this->Email,
                                                       $this->Phone,
                                                       $this->FacebookLink,
                                                       $this->TwitterLink,
                                                       $this->ProfileID);
            $this->Message = "Association ajoutée correctement";
        }

        else
            $this->Message = "Il manque un/des champ(s) obligatoire(s)";
    }

    private function IsAssoDataCorrectlyRetrieved()
    {
        return ((!is_null($this->NameAsso) && !empty($this->NameAsso))
                && (!is_null($this->AssoDescription) && !empty($this->AssoDescription))
                && (!is_null($this->Logo) && !empty($this->Logo))
                && (!is_null($this->ProfileID) && !empty($this->ProfileID)));
    }

    public function UpdateAsso(int $ID)
    {
        if ($this->IsAssoFormComplete() && $this->IsAssoDataCorrectlyRetrieved())

        {
            $this->AssociationsQueries->UpdateAssociation($ID,
                                                          $this->NameAsso,
                                                          $this->Acronym,
                                                          $this->AssoDescription,
                                                          $this->Logo,
                                                          $this->ProfileID,
                                                          $this->Email,
                                                          $this->Phone,
                                                          $this->FacebookLink, 
                                                          $this->TwitterLink);
            $this->Message = "L'association a correctement été mise à jour";
        }

        else
        {
            $this->Message = "Remplissez les champs obligatoires";
        }
    }

    public function DeleteAsso(int $ID)
    {
        $this->AssociationsQueries->DeleteAssociation($ID);
        $this->Message = "L'association a correctement été supprimée";
    }

    public function RequireView(string $CRUD, string $Message = null, $IdAsso = null)
    {
        if (is_null($Message))
            $Message = $this->Message;

        $UserManagement = new \Model\UserManagement();
        $Profiles = $UserManagement->GetProfile(null);

        if (!is_null($IdAsso) && !empty($IdAsso))
            $Asso = $this->AssociationsQueries->GetAssociation($IdAsso);

        switch ($CRUD)
        {
            case "List":
                $Associations = $this->AssociationsQueries->GetAssociation();
                return require_once('views/manage/assos/ManageAssos.view.php');
                break;

            case "Add":
                return require_once('views/manage/assos/AddAsso.view.php');
                break;

            case "Edit":
                if (!isset($Asso) || is_null($Asso)) throw new \Exception("Mauvais paramètre : cette association n'existe pas");
                return require_once('views/manage/assos/EditAsso.view.php');
                break;

            case "Delete":
                if (!isset($Asso) || is_null($Asso)) throw new \Exception("Mauvais paramètre : cette association n'existe pas");
                return require_once('views/manage/assos/DeleteAsso.view.php');
                break; 
        }
    }
}

?>
