<?php namespace Controller;

require_once('controllers/Common.controller.php');
require_once('models/User.class.php');

class LogIn extends CommonController
{
    private $UserManagement;

    private $Username, $Password;

    public function __construct()
    {
        if(self::Connected())
            throw new \Exception("Vous êtes déjà connecté");

        $this->UserManagement = new \Model\UserManagement();

        if (self::AreFieldsPresent("username", "password"))
        {
            $this->Username = $_POST['username'];
            $this->Password = $_POST['password'];
        }
    }

    private function IsLogInFormValid()
    {
        return (isset($this->Username) && isset($this->Password)
            && !empty($this->Username) && !empty($this->Password));
    }

    public function ConnectAccount()
    {
        if ($this->IsLogInFormValid())
        {
            $Account = $this->UserManagement->CheckAccount($this->Username, $this->Password);
            if (!is_null($Account) && self::IsAccountActive($Account))
            {
                $_SESSION['connected'] = true;
                $_SESSION['id_user'] = $Account['id_user'];
                $_SESSION['id_profile'] = $Account['id_profile'];
                if (self::IsManager($Account))
                    $_SESSION['manager'] = true;
                $this->Message = "Vous êtes bien connecté, vous allez être redirigé vers votre profil";
                header('Location: /myprofile');
            }

            else if (!is_null($Account) && !self::IsAccountActive($Account))
                $this->Message = "Votre compte est désactivé. Contactez-nous pour récupérer votre accès.";

            else
                $this->Message = "Identifiant et/ou mot de passe incorrect";
        }

        else
            $this->Message = "Identifiant et/ou mot de passe manquant";
    }

    public static function RequireView(string $Message = null)
    {
        if(self::Connected())
            throw new \Exception("Vous êtes déjà connecté");

        return require_once('views/LogIn.view.php');
    }
}

?>
