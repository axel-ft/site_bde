<?php namespace Controller;

require_once('controllers/Common.controller.php');
require_once('models/User.class.php');

class SignUp extends CommonController
{
    private $UserManagement;

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
        if(self::Connected())
            throw new \Exception('<div class="alert alert-warning alert-light alert-dismissible text-center" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                        <i class="zmdi zmdi-close"></i>
                                    </button>
                                    <strong><i class="zmdi zmdi-alert-triangle"></i></strong>Vous êtes déjà connecté. Pour créer un nouveau compte, déconnectez-vous de ce compte.
                                  </div>');

        $this->UserManagement = new \Model\UserManagement();

        if (self::AreFieldsPresent("username", "password", "password_confirm", "first_name", "last_name", "email"))
        {
            $this->Username = self::ValidateStringField("username");
            $this->Password = self::ValidateStringField("password");
            $this->PasswordConfirm = self::ValidateStringField("password_confirm");
            $this->FirstName = self::ValidateStringField("first_name");
            $this->LastName = self::ValidateStringField("last_name");
            $this->Email = self::ValidateStringField("email");
            $this->Avatar = self::ValidateUploadedImage("avatar", "avatars");
            $this->FacebookLink = self::ValidateStringField("facebook_link");
        }
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
        if ($this->IsSignUpFormComplete() && !$this->UserManagement->IsMailPresent($this->Email))
        {
            if ($this->PasswordsMatch($this->Password, $this->PasswordConfirm))
            {
                $this->UserManagement->NewProfile($this->FirstName, $this->LastName, $this->Email, $this->Avatar, null, null, $this->FacebookLink);
                $this->UserManagement->NewUserAccount($this->Username, $this->Password, $this->Email);
                $this->Message = '<div class="alert alert-success alert-light alert-dismissible text-center" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                        <i class="zmdi zmdi-close"></i>
                                    </button>
                                    <strong><i class="zmdi zmdi-check"></i></strong>Votre compte a correctement été créé
                                  </div>';
            }

            else
                $this->Message = '<div class="alert alert-danger alert-light alert-dismissible text-center" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                        <i class="zmdi zmdi-close"></i>
                                    </button>
                                    <strong><i class="zmdi zmdi-close-circle"></i></strong>Les deux mots de passe ne correspondent pas
                                  </div>';
        }

        else if ($this->IsSignUpFormComplete() && $this->UserManagement->IsMailPresent($this->Email))
            $this->Message = '<div class="alert alert-warning alert-light alert-dismissible text-center" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                    <i class="zmdi zmdi-close"></i>
                                </button>
                                <strong><i class="zmdi zmdi-alert-triangle"></i></strong>Il existe déjà un compte avec cette adresse mail
                              </div>';

        else
            $this->Message = '<div class="alert alert-danger alert-light alert-dismissible text-center" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                    <i class="zmdi zmdi-close"></i>
                                </button>
                                <strong><i class="zmdi zmdi-close-circle"></i></strong>Remplissez les champs obligatoires
                              </div>';
    }

    public static function RequireView(string $Message = null)
    {
        if(self::Connected())
            throw new \Exception('<div class="alert alert-warning alert-light alert-dismissible text-center" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                        <i class="zmdi zmdi-close"></i>
                                    </button>
                                    <strong><i class="zmdi zmdi-alert-triangle"></i></strong>Vous êtes déjà connecté. Pour créer un nouveau compte, déconnectez-vous de ce compte.
                                  </div>');

        return require_once('views/SignUp.view.php');
    }
}

?>
