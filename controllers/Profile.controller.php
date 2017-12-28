<?php namespace Controller;

require_once('controllers/Common.controller.php');
require_once('models/User.class.php');

class Profile extends CommonController {
    private $UserManagement;
    private $ConnectedAccount;
    private $ConnectedProfile;

    private $Username,
            $Password,
            $PasswordConfirm,
            $FirstName,
            $LastName,
            $Email,
            $Avatar,
            $DescrptionProfile,
            $IDAsso,
            $Position,
            $FacebookLink,
            $TwitterLink,
            $Phone;

    public function __construct()
    {
        $this->UserManagement = new \Model\UserManagement();
        $this->LoadAccountAndProfileFromDataBase();
    }

    private function LoadAccountAndProfileFromDataBase()
    {
        if (self::Connected())
        {
            $this->ConnectedAccount = $this->UserManagement->GetUser($_SESSION['id_user']);
            $this->ConnectedProfile = $this->UserManagement->GetProfile($_SESSION['id_profile']);
        }

        else
        {
            $this->Message = '<div class="alert alert-danger alert-light alert-dismissible text-center" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                    <i class="zmdi zmdi-close"></i>
                                </button>
                                <strong><i class="zmdi zmdi-close-circle"></i></strong>Vous n\'êtes pas connecté. Veuillez vous identifier
                              </div>';
            throw new \Exception($this->Message);
        }
    }

    public function GetAccountAndProfile()
    {
        $this->LoadAccountAndProfileFromDataBase();

        return array ($this->ConnectedAccount, $this->ConnectedProfile);
    }

    private function UpdateProfileRequest()
    {
        $FormFull;

        if ($FormFull = self::AreFieldsPresent("username", "first_name", "last_name", "email"))
        {
            $this->Username = self::ValidateStringField("username");
            $this->Password = self::ValidateStringField("password");
            $this->PasswordConfirm = self::ValidateStringField("password_confirm");;
            $this->FirstName = self::ValidateStringField("first_name");
            $this->LastName = self::ValidateStringField("last_name");
            $this->Email = self::ValidateStringField("email");
            $this->Avatar = self::ValidateUploadedImage("avatar", "avatars");
            $this->DescriptionProfile = self::ValidateStringField("description_profile");
            $this->IDAsso = self::ValidateIntField("id_asso");
            $this->Position = self::ValidateStringField("position");
            $this->FacebookLink = self::ValidateStringField("facebook_link");
            $this->TwitterLink = self::ValidateStringField("twitter_link");
            $this->Phone = self::ValidateStringField("phone");
        }

        return $FormFull;
    }

    private function IsUpdateProfileFormComplete()
    {
        return ((isset($this->Username) && !empty($this->Username))
                && (isset($this->FirstName) && !empty($this->FirstName))
                && (isset($this->LastName) && !empty($this->LastName))
                && (isset($this->Email) && !empty($this->Email)));
    }

    private function PasswordUpdateAndMatch()
    {
        $IsPasswordPresent = (!is_null($this->Password) && !empty($this->Password) &&
            !is_null($this->PasswordConfirm) && !empty($this->PasswordConfirm) &&
            $this->Password === $this->PasswordConfirm);

        if (!is_null($this->Password) && !empty($this->Password) &&
            !is_null($this->PasswordConfirm) && !empty($this->PasswordConfirm) &&
            $this->Password !== $this->PasswordConfirm)
                $this->Message = '<div class="alert alert-danger alert-light alert-dismissible text-center" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                        <i class="zmdi zmdi-close"></i>
                                    </button>
                                    <strong><i class="zmdi zmdi-close-circle"></i></strong>Les deux mots de passe ne correspondent pas
                                  </div>';

        return $IsPasswordPresent;

    }

    public function UpdateAccount()

    {
        if ($this->UpdateProfileRequest() && $this->IsUpdateProfileFormComplete())

        {
            $this->UserManagement->UpdateProfile(intval($this->ConnectedProfile['id_profile']), $this->FirstName, $this->LastName, $this->Email, $this->Avatar, $this->DescriptionProfile, $this->IDAsso, $this->Position, $this->FacebookLink, $this->TwitterLink, $this->Phone);
            $this->UserManagement->UpdateUsername($this->ConnectedAccount['id_user'], $this->Username);
            $this->Message = '<div class="alert alert-success alert-light alert-dismissible text-center" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                    <i class="zmdi zmdi-close"></i>
                                </button>
                                <strong><i class="zmdi zmdi-check"></i></strong>Votre compte a correctement été mis à jour
                              </div>';
            if ($this->PasswordUpdateAndMatch())
                $this->UserManagement->UpdatePassword($this->ConnectedAccount['id_user'], $this->Password);
        }

        else
        {
            $this->Message = '<div class="alert alert-danger alert-light alert-dismissible text-center" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                    <i class="zmdi zmdi-close"></i>
                                </button>
                                <strong><i class="zmdi zmdi-close-circle"></i></strong>Remplissez les champs obligatoires
                              </div>';
        }
    }

    public function DeactivateAccount(int $ID = null)
    {
        if (is_null($ID))
            $ID = intval($this->ConnectedAccount['id_user']);

        if(self::IsFieldPresent("password_conf") && $this->UserManagement->CheckPassword($ID, $_POST['password_conf']))

        {
            $this->UserManagement->DeactivateAccount($ID);
            session_destroy();
            $this->Message = '<div class="alert alert-info alert-light alert-dismissible text-center" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                    <i class="zmdi zmdi-close"></i>
                                </button>
                                <strong><i class="zmdi zmdi-info"></i></strong>Compte correctement désactivé
                              </div>';
            return true;
        }

        else
        {
            $this->Message = '<div class="alert alert-danger alert-light alert-dismissible text-center" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                    <i class="zmdi zmdi-close"></i>
                                </button>
                                <strong><i class="zmdi zmdi-close-circle"></i></strong>Le mot de passe entré est vide ou incorrect
                              </div>';
        }

        return false;
    }

    public function RequireView(array $AccountAndProfile = null, string $Message = null)
    {
        if (is_null($AccountAndProfile))
            $AccountAndProfile = $this->GetAccountAndProfile();

        if(is_null($Message))
            $Message = $this->Message;

        require_once('views/MyProfile.view.php');
    }
}

?>
