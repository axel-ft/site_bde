<?php namespace Controller;

require_once "controllers/Common.controller.php";
require_once "models/Association.class.php";
require_once "models/User.class.php";

class Associations extends CommonController
{
    private $AssociationsQueries;

    public function __construct()
    {
        $this->AssociationsQueries = new \Model\Association();
    }

    public function RequireView(string $Message = null, $IdAsso = null)
    {
        if (is_null($Message))
            $Message = $this->Message;

        $UserManagement = new \Model\UserManagement();
        $Profiles = $UserManagement->GetProfile();

        if (!is_null($IdAsso) && !empty($IdAsso))
            $Asso = $this->AssociationsQueries->GetAssociation($IdAsso);
        else
        {
            $Associations = $this->AssociationsQueries->GetAssociation();
            return require_once('views/Associations.view.php');
        }
    }
}

