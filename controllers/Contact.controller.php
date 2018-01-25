<?php namespace Controller;

require_once "controllers/Common.controller.php";
require_once "models/User.class.php";

class Contact extends CommonController
{
    private $ProfileQuery;
    private $ConnectedProfile;

    public function __construct()
    {
        if (self::Connected())
        {
            $this->ProfileQuery = new \Model\UserManagement();
            $this->ConnectedProfile = $this->ProfileQuery->GetProfile($_SESSION['id_profile']);
        }

    }

    public function RequireView(string $Message = null)
    {
        return require_once('views/Contact.view.php');
    }
}

?>
