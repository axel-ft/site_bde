<?php namespace Controller;

require_once "controllers/Common.controller.php";
require_once "models/Association.class.php";
require_once "models/User.class.php";
require_once "models/Staff.model.php";
require_once "models/Events.class.php";

class Associations extends CommonController
{
    private $AssociationsQueries,
            $StaffQueries,
            $EventsQueries;

    public function __construct()
    {
        $this->AssociationsQueries = new \Model\Association();
        $this->StaffQueries = new \Model\Staff();
        $this->EventsQueries = new \Model\Event();
    }

    public function RequireView(string $Message = null, int $IdAsso = null)
    {
        if (is_null($Message))
            $Message = $this->Message;

        $UserManagement = new \Model\UserManagement();
        $Profiles = $UserManagement->GetProfile();

        if (!is_null($IdAsso) && !empty($IdAsso))
        {
            if (!is_null($Events = $this->EventsQueries->GetMonthEvents(\date('Y'), \date('n'), $IdAsso)))
                $Events = self::ConstructDateTimes($Events, array("begin_date", "end_date"));

            $Asso = $this->AssociationsQueries->GetAssociation($IdAsso);
            $Staff = $this->StaffQueries->GetAssoStaff($IdAsso);
            return require_once('views/Association.view.php');
        }

        else
        {
            $Associations = $this->AssociationsQueries->GetAssociation();
            return require_once('views/Associations.view.php');
        }
    }
}

