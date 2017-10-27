<?php namespace Controller;

require_once('models/User.class.php');

class LogIn
{
    private $UserManagement;
    private $Message;

    private $Username, $Password;

    public function __construct()
    {
        $this->UserManagement = new \Model\UserManagement();

        if (isset($_POST['username']) && isset($_POST['password'])
            && !empty($_POST['username']) && !empty($_POST['password']))
        {
            $this->Username = $_POST['username'];
            $this->Password = $_POST['password'];
        }
    }

    public function GetMessage()
    {
        return (isset($this->Message) & !empty($this->Message)) ? $this->Message : null;
    }

    private function IsAccountActive($Account)
    {
        return (intval($Account['active']) === 1);
    }

    private function IsManager($Account) {
        return (intval($Account['admin']) === 1);
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
            if ($Account !== null && $this->IsAccountActive($Account))
            {
                $_SESSION['connected'] = true;
                $_SESSION['id_user'] = $Account['id_user'];
                $_SESSION['id_profile'] = $Account['id_profile'];
                if ($this->IsManager($Account))
                {
                    $_SESSION['manager'] = true;
                }
                $this->Message = "Vous êtes bien connecté, vous allez être redirigé vers votre profil";
                header('Location: profile');
            }

            else if (!$this->IsAccountActive($Account))
                $this->Message = "Votre compte est désactivé. Contactez-nous pour récupérer votre accès.";

            else
                $this->Message = "Identifiant et/ou mot de passe incorrect";
        }

        else
        {
            $this->Message = "Identifiant et/ou mot de passe manquant";
        }
    }

    public static function RequireView(string $Message = null)
    {
        return require_once('views/LogIn.view.php');
    }
}

?>
