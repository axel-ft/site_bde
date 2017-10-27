<?php namespace Controller;

require_once('models/User.class.php');

class SignUp
{
    private $UserManagement;
    private $Message;

    private $Username,
            $Password,
            $PasswordConfirm,
            $FirstName,
            $LastName,
            $Email,
            $Avatar,
            $FacebookLink;

    public function __construct()
    {
        $this->UserManagement = new \Model\UserManagement();

        if ((isset($_POST['username']) && !empty($_POST['username']))
                && (isset($_POST['password']) && !empty($_POST['password']))
                && (isset($_POST['password_confirm']) && !empty($_POST['password_confirm']))
                && (isset($_POST['first_name']) && !empty($_POST['first_name']))
                && (isset($_POST['last_name']) && !empty($_POST['last_name']))
                && (isset($_POST['email']) && !empty($_POST['email'])))
        {
            $this->Username = trim($_POST['username']);
            $this->Password = $_POST['password'];
            $this->PasswordConfirm = $_POST['password_confirm'];
            $this->FirstName = trim($_POST['first_name']);
            $this->LastName = trim($_POST['last_name']);
            $this->Email = trim($_POST['email']);
            $this->Avatar = (isset($_POST['avatar']) && !empty($_POST['avatar'])) ? $_POST['avatar'] : null;
            $this->FacebookLink = (isset($_POST['facebook_link']) && !empty($_POST['facebook_link'])) ? $_POST['facebook_link'] : null;
        }
    }

    public function GetMessage()
    {
        return (isset($this->Message) & !empty($this->Message)) ? $this->Message : null;
    }

    private function IsSignUpFormComplete()
    {
        return ((isset($this->Username) && !empty($this->Username))
                && (isset($this->Password) && !empty($this->Password))
                && (isset($this->PasswordConfirm) && !empty($this->PasswordConfirm))
                && (isset($this->FirstName) && !empty($this->FirstName))
                && (isset($this->LastName) && !empty($this->LastName))
                && (isset($this->Email) && !empty($this->Email)));
    }

    private function PasswordsMatch(string $Password, string $PasswordConfirm)
    {
        return ($Password === $PasswordConfirm);
    }

    public function CreateAccount()
    {
        if ($this->IsSignUpFormComplete())
        {
            if ($this->PasswordsMatch($this->Password, $this->PasswordConfirm))
            {
                $this->UserManagement->NewProfile($this->FirstName, $this->LastName, $this->Email, $this->Avatar, null, null, $this->FacebookLink);
                $this->UserManagement->NewUserAccount($this->Username, $this->Password, $this->Email);
                $this->Message = "Votre compte a correctement été créé";
            }

            else
            {
                $this->Message = "Les deux mots de passe ne correspondent pas";
            }
        }

        else
        {
            $this->Message = "Remplissez les champs obligatoires";
        }
    }

    public static function RequireView(string $Message = null)
    {
        return require_once('views/SignUp.view.php');
    }
}

?>
