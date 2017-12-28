<?php namespace Controller;

require_once "controllers/Common.controller.php";
require_once "models/Events.class.php";

class Home extends CommonController
{
    private $EventsQueries;

    public function __construct()
    {
        $this->EventsQueries = new \Model\Event();
    }

    private static function ConstructDateTimes(array $Events)
    {
        if (!is_null($Events) && !empty($Events))
        {
            $i = 0;

            foreach ($Events as $Event)
            {
                $Events[$i]['begin_date'] = new \DateTime($Event['begin_date']);
                $Events[$i]['end_date'] = new \DateTime($Event['end_date']);
                $i++;
            }

            return $Events;
        }

        else
            return null;
    }

    public function RequireView(string $Message = null)
    {
        $Events = (!is_null($this->EventsQueries->GetEvent())) ? self::ConstructDateTimes($this->EventsQueries->GetEvent()) : null;

        return require_once('views/Home.view.php');
    }
}

?>
