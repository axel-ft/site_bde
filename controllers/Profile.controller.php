<?php namespace Controller;

require_once('models/User.class.php');

class Profile {
    private $UserManagement;
    private $ConnectedAccount;
    private $ConnectedProfile;
    private $Message;

    private $Username,
            $Password,
            $PasswordConfirm,
            $FirstName,
            $LastName,
            $Email,
            $Avatar,
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
        if (isset($_SESSION['connected']) && $_SESSION['connected']
            && isset($_SESSION['id_user']) && !empty($_SESSION['id_user'])
            && isset($_SESSION['id_profile']) && !empty($_SESSION['id_profile']))
        {
            $this->ConnectedAccount = $this->UserManagement->GetUser($_SESSION['id_user']);
            $this->ConnectedProfile = $this->UserManagement->GetProfile($_SESSION['id_profile']);
        }

        else
        {
            $this->Message = "Vous n'êtes pas connecté. Veuillez vous identifier";
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

        if ($FormFull = ((isset($_POST['username']) && !empty($_POST['username']))
                && (isset($_POST['first_name']) && !empty($_POST['first_name']))
                && (isset($_POST['last_name']) && !empty($_POST['last_name']))
                && (isset($_POST['email']) && !empty($_POST['email']))))
        {
            $this->Username = trim($_POST['username']);
            $this->Password = (isset($_POST['password']) && !empty($_POST['password'])) ? $_POST['password'] : null;
            $this->PasswordConfirm = (isset($_POST['password_confirm']) && !empty($_POST['password_confirm'])) ? $_POST['password_confirm'] : null;
            $this->FirstName = trim($_POST['first_name']);
            $this->LastName = trim($_POST['last_name']);
            $this->Email = trim($_POST['email']);
            $this->Avatar = (isset($_POST['avatar']) && !empty($_POST['avatar'])) ? $_POST['avatar'] : null;
            $this->IDAsso = (isset($_POST['id_asso']) && !empty($_POST['id_asso'])) ? intval($_POST['id_asso']) : null;
            $this->Position = (isset($_POST['position']) && !empty($_POST['position'])) ? $_POST['position'] : null;
            $this->FacebookLink = (isset($_POST['facebook_link']) && !empty($_POST['facebook_link'])) ? $_POST['facebook_link'] : null;
            $this->TwitterLink = (isset($_POST['twitter_link']) && !empty($_POST['twitter_link'])) ? $_POST['twitter_link'] : null;
            $this->Phone = (isset($_POST['phone']) && !empty($_POST['phone'])) ? $_POST['phone'] : null;
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
                $this->Message = "Les deux mots de passe ne correspondent pas";

        return $IsPasswordPresent;
    }

    public function UpdateAccount()
    {
        if ($this->UpdateProfileRequest() && $this->IsUpdateProfileFormComplete())
        {
            $this->UserManagement->UpdateProfile(intval($this->ConnectedProfile['id_profile']), $this->FirstName, $this->LastName, $this->Email, $this->Avatar, $this->IDAsso, $this->Position, $this->FacebookLink, $this->TwitterLink, $this->Phone);
            $this->UserManagement->UpdateUsername($this->ConnectedAccount['id_user'], $this->Username);
            $this->Message = "Votre compte a correctement été mis à jour";

            if ($this->PasswordUpdateAndMatch())
                $this->UserManagement->UpdatePassword($this->ConnectedAccount['id_user'], $this->Password);
        }

        else
        {
            $this->Message = "Remplissez les champs obligatoires";
        }
    }

    public function DeactivateAccount(int $ID = null)
    {
        if (is_null($ID))
            $ID = intval($this->ConnectedAccount['id_user']);

        if(isset($_POST['password_conf']) && !empty($_POST['password_conf']) && $this->UserManagement->CheckPassword($ID, $_POST['password_conf']))
        {
            $this->UserManagement->DeactivateAccount($ID);
            session_destroy();
            $this->Message = "Compte correctement désactivé";
            return true;
        }

        else
        {
            $this->Message = "Le mot de passe entré est vide ou incorrect";
        }

        return false;
    }

    public function GetMessage()
    {
        return (isset($this->Message) && !empty($this->Message)) ? $this->Message : null;
    }

    public function RequireView(array $AccountAndProfile = null, string $Message = null)
    {
        if (is_null($AccountAndProfile))
            $AccountAndProfile = $this->GetAccountAndProfile();

        if(is_null($Message))
            $Message = $this->Message;

        require_once('views/Profile.view.php');
    }
}

?>
