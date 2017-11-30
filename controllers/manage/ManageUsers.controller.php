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

    private function IsCreateUserFormComplete()
    {
        if ($IsCreateUserFormComplete = (self::AreFieldsPresent("username", "password", "password_confirm", "first_name", "last_name", "email") || self::AreFieldsPresent("username", "password", "password_confirm", "profile")))
        {
            $this->UserName = self::ValidateStringField("username");
            $this->Password = self::ValidateStringField("password");
            $this->PasswordConfirm = self::ValidateStringField("password_confirm");
            $this->Admin = self::ValidateIntField("role");
            if (!is_null($this->Admin) && ($this->Admin > 2 || $this->Admin < 0)) $this->Admin = null;
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

        return $IsCreateUserFormComplete;
    }

    private function IsUpdateUserFormComplete()
    {
        if ($IsUpdateUserFormComplete = (self::AreFieldsPresent("username", "role")))
        {
            $this->UserName = self::ValidateStringField("username");
            $this->Password = self::ValidateStringField("password");
            $this->PasswordConfirm = self::ValidateStringField("password_confirm");
            $this->Admin = self::ValidateIntField("role");
            if (!is_null($this->Admin) && ($this->Admin > 2 || $this->Admin < 0)) $this->Admin = null;
            $this->Active = self::ValidateStringField("active");
        }

        return $IsUpdateUserFormComplete;
    }

    private function PasswordsMatch(string $Password, string $PasswordConfirm)
    {
        return ($Password === $PasswordConfirm);
    }

    private function UsernameAndMailCheck()
    {
        $BasicChecksPass;

        if ($BasicChecksPass = (($this->IsProfileDataCorrectlyRetrieved() || $this->IsAccountDataCorrectlyRetrieved()) && $this->UserManagement->IsUsernamePresent($this->UserName) && !is_null($this->Email) && $this->UserManagement->IsMailPresent($this->Email)))
        {
            $this->Message = "Il existe déjà un compte avec cette adresse mail et ce  nom d'utilisateur";
            return $BasicChecksPass;
        }

        else if ($BasicChecksPass = (($this->IsProfileDataCorrectlyRetrieved() || $this->IsAccountDataCorrectlyRetrieved()) && $this->UserManagement->IsUsernamePresent($this->UserName)))
        {
            $this->Message = "Il existe déjà un compte avec ce nom d'utilisateur";
            return $BasicChecksPass;
        }

        else if ($BasicChecksPass = (($this->IsProfileDataCorrectlyRetrieved() || $this->IsAccountDataCorrectlyRetrieved()) && !is_null($this->Email) && $this->UserManagement->IsMailPresent($this->Email)))
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

         if ($this->IsCreateUserFormComplete()
            && !$this->UserManagement->IsUsernamePresent($this->UserName)
            && (is_null($this->Email) || (!is_null($this->Email && !$this->UserManagement->IsMailPresent($this->Email)))))
         {
            if (!$this->PasswordsMatch($this->Password, $this->PasswordConfirm))
            {
                $this->Message = "Les deux mots de passe ne correspondent pas";
                return;
            }

            if (is_null($this->ProfileID) && $this->IsProfileDataCorrectlyRetrieved() && $this->IsUserDataCorrectlyRetrieved())
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

            $this->UserManagement->UpdateRole($this->UserManagement->GetUserId($this->UserName), $this->Admin);
            $this->UpdateActiveState();
            $this->Message = "Utilisateur/Profil ajouté(s) correctement";
        }

        else
            $this->Message = "Il manque un/des champ(s) obligatoire(s)";
    }

    private function UpdateActiveState()
    {
        if (!is_null($this->Active) && $this->Active === "yes")
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

    private function IsAccountDataCorrectlyRetrieved()
    {
        return ((!is_null($this->UserName) && !empty($this->UserName))
                && (!is_null($this->Admin) && (!empty($this->Admin) || $this->Admin === 0))
                && (is_null($this->Active) || $this->Active === "yes"));
    }

    public function UpdateUser(int $ID)
    {
        if ($this->UsernameAndMailCheck())
            return;

        if ($this->IsUpdateUserFormComplete() && $this->IsAccountDataCorrectlyRetrieved())
        {
            if ((!is_null($this->Password) && !empty($this->Password))
                && (!is_null($this->PasswordConfirm) && !empty($this->PasswordConfirm))
                && $this->PasswordsMatch($this->Password, $this->PasswordConfirm))
                $this->UserManagement->UpdatePassword($ID, $this->Password);
            
            else if ((self::IsFieldPresent("password") || self::IsFieldPresent("password_confirm")) && (is_null($this->Password) || is_null($this->PasswordConfirm)))
            {
                $this->Message = "Il faut confirmer le mot de passe";
                return;
            }

            else if ((!is_null($this->Password) && !empty($this->Password))
                    && (!is_null($this->PasswordConfirm) && !empty($this->PasswordConfirm))
                    && !$this->PasswordsMatch($this->Password, $this->PasswordConfirm))
            {
                $this->Message = "Les deux mots de passe ne correspondent pas";
                return;
            }
            
            $this->UserManagement->UpdateUsername($ID, $this->UserName);
            $this->UserManagement->UpdateRole($ID, $this->Admin);
            $this->UpdateActiveState();

            $this->Message = "Le compte a correctement été mise à jour";
        }

        else
            $this->Message = "Il manque un/des champ(s) obligatoire(s)";
    }

    public function DeactivateUser(int $ID)
    {
        $this->UserManagement->DeactivateAccount($ID);
        $this->Message = "Le compte a bien été désactivé";
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
