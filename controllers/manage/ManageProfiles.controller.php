<?php namespace Controller;

require_once "controllers/Common.controller.php";
require_once "models/Association.class.php";
require_once "models/User.class.php";

class ManageProfiles extends CommonController
{
    private $UserManagement;
    private $FirstName,
            $LastName,
            $Email,
            $Avatar,
            $ProfileDescription,
            $AssoID,
            $Position,
            $FacebookLink,
            $TwitterLink,
            $Phone;

    public function __construct()
    {
        if (self::IsManager())
           throw new \Exception("Vous n'avez pas les droits suffisants pour accéder à cette page"); 

        $this->UserManagement = new \Model\UserManagement();
    }

    private function IsProfileFormComplete()
    {
        if ($IsProfileFormComplete = (self::AreFieldsPresent("first_name", "last_name", "email")))
        {
            $this->FirstName = self::ValidateStringField("first_name");
            $this->LastName = self::ValidateStringField("last_name");
            $this->Email = self::ValidateStringField("email");
            $this->Avatar = self::ValidateStringField("avatar");
            $this->ProfileDescription = self::ValidateStringField("description_profile");
            $this->AssoID = self::ValidateIntField("asso");
            $this->Position = self::ValidateStringField("position");
            $this->FacebookLink = self::ValidateStringField("facebook_link");
            $this->TwitterLink = self::ValidateStringField("twitter_link");
            $this->Phone = self::ValidateStringField("phone");
        }

        return $IsProfileFormComplete;
    }

    public function AddProfile()
    {
        if ($this->IsProfileFormComplete() && !$this->UserManagement->IsMailPresent($this->Email))
        {
            $this->UserManagement->NewProfile($this->FirstName,
                                              $this->LastName,
                                              $this->Email,
                                              $this->Avatar,
                                              $this->ProfileDescription,
                                              $this->AssoID,
                                              $this->Position,
                                              $this->FacebookLink,
                                              $this->TwitterLink,
                                              $this->Phone);
            $this->Message = "Profil ajouté correctement";
        }

        if ($this->IsProfileFormComplete() && $this->UserManagement->IsMailPresent($this->Email))
            $this->Message = "Il existe déjà un compte avec cette adresse mail";

        else
            $this->Message = "Il manque un/des champ(s) obligatoire(s)";
    }

    private function IsProfileDataCorrectlyRetrieved()
    {
        return ((!is_null($this->FirstName) && !empty($this->FirstName))
                && (!is_null($this->LastName) && !empty($this->LastName))
                && (!is_null($this->Email) && !empty($this->Email)));
    }

    public function UpdateProfile(int $ID)
    {
        if ($this->IsProfileFormComplete() && $this->IsProfileDataCorrectlyRetrieved())

        {
            $this->UserManagement->UpdateProfile($ID,
                                                 $this->FirstName,
                                                 $this->LastName,
                                                 $this->Email,
                                                 $this->Avatar,
                                                 $this->ProfileDescription,
                                                 $this->AssoID,
                                                 $this->Position,
                                                 $this->FacebookLink, 
                                                 $this->TwitterLink,
                                                 $this->Phone);
            $this->Message = "L'association a correctement été mise à jour";
        }

        else
            $this->Message = "Remplissez les champs obligatoires";
    }

    public function DeleteProfile(int $ID, bool $DryRun = false)
    {
        if ($this->UserManagement->IsProfileLinkedToAccount($ID))
        {
            if (!$DryRun)
            {
                $this->UserManagement->HideProfile($ID);
                $this->UserManagement->DeactivateAccountFromProfile($ID);
                $this->Message = "Le profil a correctement été masqué, et l'utilisateur correspondant désactivé";
            }
            return false;
        }

        else
        {
            if (!$DryRun)
            {
                $this->UserManagement->DeleteProfile($ID);
                $this->Message = "Le profil a correctement été supprimé";
            }
            return true;
        }
    }

    public function RequireView(string $CRUD, string $Message = null, $ProfileID = null)
    {
        if (is_null($Message))
            $Message = $this->Message;

        $AssociationsQueries = new \Model\Association();
        $Associations = $AssociationsQueries->GetAssociation();

        if (!is_null($ProfileID) && !empty($ProfileID))
            $Profile = $this->UserManagement->GetProfile($ProfileID);

        switch ($CRUD)
        {
            case "List":
                $Profiles = $this->UserManagement->GetProfile();
                return require_once('views/manage/profiles/ManageProfiles.view.php');
                break;

            case "Add":
                return require_once('views/manage/profiles/AddProfile.view.php');
                break;

            case "Edit":
                if (!isset($Profile) || is_null($Profile)) throw new \Exception("Mauvais paramètre : ce profil n'existe pas");
                return require_once('views/manage/profiles/EditProfile.view.php');
                break;

            case "Delete":
                if (!isset($Profile) || is_null($Profile)) throw new \Exception("Mauvais paramètre : ce profil n'existe pas");
                return require_once('views/manage/profiles/DeleteProfile.view.php');
                break; 

            case "Hide":
                if (!isset($Profile) || is_null($Profile)) throw new \Exception("Mauvais paramètre : ce profil n'existe pas");
                return require_once('views/manage/profiles/HideProfile.view.php');
                break; 
        }
    }
}

?>
