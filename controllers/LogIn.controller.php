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
            throw new \Exception('<div class="alert alert-warning alert-light alert-dismissible text-center" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                        <i class="zmdi zmdi-close"></i>
                                    </button>
                                    <strong><i class="zmdi zmdi-alert-triangle"></i></strong>Vous êtes déjà connecté
                                  </div>');

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
                $this->Message = '<div class="alert alert-success alert-light alert-dismissible text-center" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                        <i class="zmdi zmdi-close"></i>
                                    </button>
                                    <strong><i class="zmdi zmdi-check"></i></strong>Vous êtes bien connecté, vous allez être redirigé vers votre profil
                                  </div>';
                header('Location: /myprofile');
            }

            else if (!is_null($Account) && !self::IsAccountActive($Account))
                $this->Message = '<div class="alert alert-warning alert-light alert-dismissible text-center" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                        <i class="zmdi zmdi-close"></i>
                                    </button>
                                    <strong><i class="zmdi zmdi-alert-triangle"></i></strong>Votre compte est désactivé. Contactez-nous pour récupérer votre accès
                                  </div>';

            else
                $this->Message = '<div class="alert alert-danger alert-light alert-dismissible text-center" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                        <i class="zmdi zmdi-close"></i>
                                    </button>
                                    <strong><i class="zmdi zmdi-close-circle"></i></strong>Identifiant et/ou mot de passe incorrect
                                  </div>';
        }

        else
            $this->Message = '<div class="alert alert-danger alert-light alert-dismissible text-center" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                    <i class="zmdi zmdi-close"></i>
                                </button>
                                <strong><i class="zmdi zmdi-close-circle"></i></strong>Identifiant et/ou mot de passe manquant
                              </div>';
    }

    public static function RequireView(string $Message = null)
    {
        if(self::Connected())
            throw new \Exception('<div class="alert alert-warning alert-light alert-dismissible text-center" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                        <i class="zmdi zmdi-close"></i>
                                    </button>
                                    <strong><i class="zmdi zmdi-alert-triangle"></i></strong>Vous êtes déjà connecté
                                  </div>');

        return require_once('views/LogIn.view.php');
    }
}

?>
