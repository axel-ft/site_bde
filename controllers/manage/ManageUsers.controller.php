<?php namespace Controller;

require_once "controllers/Common.controller.php";
require_once "models/Association.class.php";
require_once "models/User.class.php";

class ManageUsers extends CommonController
{
    private $UserManagement;
    private $AssoQueries;
    private $UserName,
            $Password,
            $PasswordConfirm,
            $Admin,
            $Active,
            $ProfileID,
            $FirstName,
            $LastName,
            $Email,
            $Avatar,
            $ProfileDescription,
            $AssoID,
            $Position,
            $FacebookLink,
            $TwitterLink,
            $Phone,
            $Visible;

    public function __construct()
    {
        if (self::IsManager())
           throw new \Exception("Vous n'avez pas les droits suffisants pour accéder à cette page"); 

        $this->UserManagement = new \Model\UserManagement();
        $this->AssoQueries = new \Model\Association();
    }

    private function IsUserFormComplete()
    {
        if ($IsProfileFormComplete = (self::AreFieldsPresent("username", "password", "password_confirm", "first_name", "last_name", "email") || self::AreFieldsPresent("username", "password", "password_confirm", "profile")))
        {
            $this->UserName = self::ValidateStringField("username");
            $this->Password = self::ValidateStringField("password");
            $this->PasswordConfirm = self::ValidateStringField("password_confirm");
            $this->Admin = self::ValidateIntField("role");
            $this->Active = self::ValidateStringField("active");
            $this->ProfileID = self::ValidateIntField("profile");
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

    private function PasswordsMatch(string $Password, string $PasswordConfirm)
    {
        return ($Password === $PasswordConfirm);
    }

    private function UsernameAndMailCheck()
    {
        $BasicChecksPass;

        if ($BasicChecksPass = ($this->IsUserFormComplete() && $this->UserManagement->IsUsernamePresent($this->UserName) && !is_null($this->Email) && $this->UserManagement->IsMailPresent($this->Email)))
        {
            $this->Message = "Il existe déjà un compte avec cette adresse mail et ce  nom d'utilisateur";
            return $BasicChecksPass;
        }

        else if ($BasicChecksPass = ($this->IsUserFormComplete() && $this->UserManagement->IsUsernamePresent($this->UserName)))
        {
            $this->Message = "Il existe déjà un compte avec ce nom d'utilisateur";
            return $BasicChecksPass;
        }

        else if ($BasicChecksPass = ($this->IsUserFormComplete() && !is_null($this->Email) && $this->UserManagement->IsMailPresent($this->Email)))
        {
            $this->Message = "Il existe déjà un compte avec cette adresse mail";
            return $BasicChecksPass;
        }

        return $BasicChecksPass;
    }

    public function AddUser()
    {
        if ($this->UsernameAndMailCheck())
            return;

         if ($this->IsUserFormComplete()
            && !$this->UserManagement->IsUsernamePresent($this->UserName)
            && (is_null($this->Email) || (!is_null($this->Email && !$this->UserManagement->IsMailPresent($this->Email)))))
        {
            if (!$this->PasswordsMatch($this->Password, $this->PasswordConfirm))
            {
                $this->Message = "Les deux mots de passe ne correspondent pas";
                return;
            }

            if (is_null($this->ProfileID) && $this->IsProfileDataCorrectlyRetrieved())
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
                $this->UserManagement->NewUserAccount($this->UserName, $this->Password, $this->Email);
            }

            else if (!is_null($this->ProfileID) && !empty($this->ProfileID))
                $this->UserManagement->NewUserAccount($this->UserName, $this->Password, $this->Email, $this->ProfileID);

            else
            {
                $this->Message = "Quelque chose n'a pas marché...";
                return;
            }

            $this->UpdateActiveState();
            $this->Message = "Utilisateur/Profil ajouté(s) correctement";
        }

        else
            $this->Message = "Il manque un/des champ(s) obligatoire(s)";
    }

    private function UpdateActiveState()
    {
        if (!is_null($this->Active) && $this->Active === 1)
            $this->UserManagement->ActivateAccount($this->UserManagement->GetUserId($this->UserName));
        else if (is_null($this->Active))
            $this->UserManagement->DeactivateAccount($this->UserManagement->GetUserId($this->UserName));
    }

    private function IsProfileDataCorrectlyRetrieved()
    {
        return ((!is_null($this->FirstName) && !empty($this->FirstName))
                && (!is_null($this->LastName) && !empty($this->LastName))
                && (!is_null($this->Email) && !empty($this->Email)));
    }

    public function UpdateUser(int $ID)
    {///ICICICICICICICICICICICICICICICICICICICICI
        if ($this->UsernameAndMailCheck())
            return;

        if ($this->IsUserFormComplete() && $this->IsProfileDataCorrectlyRetrieved())

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
            $this->Message = "Il manque un/des champ(s) obligatoire(s)";
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

    public function RequireView(string $CRUD, string $Message = null, $UserID = null)
    {
        if (is_null($Message))
            $Message = $this->Message;

        if (!is_null($UserID) && !empty($UserID))
            $User = $this->UserManagement->GetUser($UserID);

        $Profiles = $this->UserManagement->GetProfile();
        $Associations = $this->AssoQueries->GetAssociation();

        switch ($CRUD)
        {
            case "List":
                $Users = $this->UserManagement->GetUser();
                return require_once('views/manage/users/ManageUsers.view.php');
                break;

            case "Add":
                $FreeProfiles;
                if (!is_null($Profiles))
                    foreach ($Profiles as $Profile)
                        if (!$this->UserManagement->IsProfileLinkedToAccount($Profile['id_profile']) && intval($Profile['visible']) === 1)
                            $FreeProfiles[] = $Profile;
                return require_once('views/manage/users/AddUser.view.php');
                break;

            case "Edit":
                if (!isset($User) || is_null($User)) throw new \Exception("Mauvais paramètre : cet utilisateur n'existe pas");
                return require_once('views/manage/users/EditUser.view.php');
                break;

            case "Deactivate":
                if (!isset($User) || is_null($User)) throw new \Exception("Mauvais paramètre : cet utilisateur n'existe pas");
                return require_once('views/manage/users/DeactivateUser.view.php');
                break; 
        }
    }
}

?>
