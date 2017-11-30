<?php namespace Controller;

require_once "controllers/Common.controller.php";
require_once "models/Association.class.php";
require_once "models/Events.class.php";
require_once "models/User.class.php";

class ManageEvents extends CommonController
{
    private $EventsQueries;
    private $AssociationsQueries;
    private $EventName,
            $BeginDate,
            $EndDate,
            $EventDescription,
            $FacebookEventLink,
            $IdAsso;

    public function __construct()
    {
        if (self::IsManager())
           throw new \Exception("Vous n'avez pas les droits suffisants pour accéder à cette page"); 

        $this->EventsQueries = new \Model\Event();
        $this->AssociationsQueries = new \Model\Association();
    }

    private function IsEventFormComplete()
    {
        if ($IsEventFormComplete = (self::AreFieldsPresent("name_event", "begin_date", "end_date", "description_event", "facebook_event_link", "asso")))
        {
            $this->EventName = self::ValidateStringField("name_event");
            $this->BeginDate = self::ValidateDateField("begin_date");
            $this->EndDate = self::ValidateDateField("end_date");
            $this->EventDescription = self::ValidateStringField("description_event");
            $this->FacebookEventLink = self::ValidateStringField("facebook_event_link");
            $this->IdAsso = self::ValidateIntField("asso");
        }

        return $IsEventFormComplete;
    }

    public function AddEvent()
    {
        if ($this->IsEventFormComplete())
        {
            $this->EventsQueries->NewEvent($this->EventName,
                                           $this->BeginDate,
                                           $this->EndDate,
                                           $this->EventDescription,
                                           $this->FacebookEventLink,
                                           $this->IdAsso);
            $this->Message = "Evénement ajouté correctement";
        }

        else
            $this->Message = "Il manque un/des champ(s) obligatoire(s)";
    }

    private function IsEventDataCorrectlyRetrieved()
    {
        return ((!is_null($this->EventName) && !empty($this->EventName))
                && (!is_null($this->BeginDate) && !empty($this->BeginDate))
                && (!is_null($this->EndDate) && !empty($this->EndDate))
                && (!is_null($this->EventDescription) && !empty($this->EventDescription))
                && (!is_null($this->FacebookEventLink) && !empty($this->FacebookEventLink))
                && (!is_null($this->IdAsso) && !empty($this->IdAsso)));
    }

    public function UpdateEvent(int $ID)
    {
        if ($this->IsEventFormComplete() && $this->IsEventDataCorrectlyRetrieved())
        {
            $this->EventsQueries->UpdateEvent($ID,
                                              $this->EventName,
                                              $this->BeginDate,
                                              $this->EndDate,
                                              $this->EventDescription,
                                              $this->FacebookEventLink,
                                              $this->IdAsso);
            $this->Message = "L'événement a correctement été mise à jour";
        }

        else
            $this->Message = "Remplissez les champs obligatoires";
    }

    public function DeleteEvent(int $ID)
    {
        $this->EventsQueries->DeleteEvent($ID);
        $this->Message = "L'événement a correctement été supprimé";
    }

    public function RequireView(string $CRUD, string $Message = null, $IdEvent = null)
    {
        if (is_null($Message))
            $Message = $this->Message;

        $Assos = $this->AssociationsQueries->GetAssociation();

        if (!is_null($IdEvent) && !empty($IdEvent))
        {
            $Event = $this->EventsQueries->GetEvent($IdEvent);
            if (!is_null($Event) || !empty($Event))
            { 
                $Event['begin_date'] = new \DateTime($Event['begin_date']);
                $Event['end_date'] = new \DateTime($Event['end_date']);
            }
        }

        switch ($CRUD)
        {
            case "List":
                $Events = $this->EventsQueries->GetEvent();
                return require_once('views/manage/events/ManageEvents.view.php');
                break;

            case "Add":
                return require_once('views/manage/events/AddEvent.view.php');
                break;

            case "Edit":
                if (!isset($Event) || is_null($Event)) throw new \Exception("Mauvais paramètre : cet événement n'existe pas");
                return require_once('views/manage/events/EditEvent.view.php');
                break;

            case "Delete":
                if (!isset($Event) || is_null($Event)) throw new \Exception("Mauvais paramètre : cet événement n'existe pas");
                return require_once('views/manage/events/DeleteEvent.view.php');
                break; 
        }
    }
}

?>
