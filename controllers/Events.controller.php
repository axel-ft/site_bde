<?php namespace Controller;

require_once "controllers/Common.controller.php";
require_once "controllers/Calendar.class.php";
require_once "models/Events.class.php";

class Events extends CommonController
{
    private $EventsQueries,
            $Year,
            $Month;

    public function __construct(int $Year = null, int $Month = null)
    {
        $this->EventsQueries = new \Model\Event();
        $this->Year = (!is_null($Year)) ? $Year : \date('Y');
        $this->Month = (!is_null($Year)) ? $Month : \date('n');
    }

    public function RequireView(string $Message = null)
    {
        if (is_null($Message)) $Message = $this->Message;

        if (!is_null($Events = $this->EventsQueries->GetMonthEvents($this->Year, $this->Month)))
        $Events = self::ConstructDateTimes($Events, array("begin_date", "end_date"));

        try
        {
            $Cal = new Calendar($this->Year, $this->Month);
            $CalHTML = $Cal->GenerateOutput($Events);
        }

        catch (\Exception $e)
        {
            $this->Message = $e->getMessage();
            $Cal = new Calendar($this->Year);
            $CalHTML = $Cal->GenerateOutput($Events);
        }

        return require_once('views/Events.view.php');
    }
}

?>
