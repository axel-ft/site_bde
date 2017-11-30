<?php namespace Model;

require_once('DataBaseAccess.class.php');

/**
 * Association model class which contains all requests to the database to manage the associations
 *
 * @author Axel Floquet-Trillot
 * @link https://axelfloquet.fr
 */
class Event {

    private $DB;

    public function __construct()
    {
        $this->DB = DataBaseAccess::getInstance();
    }

    /**
     * Creates a new event
     *
     */
    public function NewEvent(string $EventName, \DateTime $BeginDate, \DateTime $EndDate, string $EventDescription, string $FacebookEventLink, int $IdAsso)
    {
        $BeginDate = $BeginDate->format('Y-m-d\TH:i:s');
        $EndDate = $EndDate->format('Y-m-d\TH:i:s');

        $Event = $this->DB->prepare('INSERT INTO events(name_event, begin_date, end_date, description_event, facebook_event_link, id_asso)
                                VALUES (:name_event, :begin_date, :end_date, :description_event, :facebook_event_link, :id_asso)');
        $Event->bindParam(':name_event',            $EventName,         \PDO::PARAM_STR);
        $Event->bindParam(':begin_date',            $BeginDate,         \PDO::PARAM_STR);
        $Event->bindParam(':end_date',              $EndDate,           \PDO::PARAM_STR);
        $Event->bindParam(':description_event',     $EventDescription,  \PDO::PARAM_STR);
        $Event->bindParam(':facebook_event_link',   $FacebookEventLink, \PDO::PARAM_STR);
        $Event->bindParam(':id_asso',               $IdAsso,            \PDO::PARAM_INT);
        $Event->execute();
    }

    /**
     * Updates a existing event
     *
     */
    public function UpdateEvent(int $ID, string $EventName, \DateTime $BeginDate, \DateTime $EndDate, string $EventDescription, string $FacebookEventLink, int $IdAsso)
    {
        $BeginDate = $BeginDate->format('Y-m-d\TH:i:s');
        $EndDate = $EndDate->format('Y-m-d\TH:i:s');

        $UpdateEvent = $this->DB->prepare('UPDATE events SET name_event = :name_event, begin_date = :begin_date, end_date = :end_date, description_event = :description_event, facebook_event_link = :facebook_event_link, id_asso = :id_asso WHERE id_event = :id_event');
        $UpdateEvent->bindParam(':id_event',              $ID,                  \PDO::PARAM_INT);
        $UpdateEvent->bindParam(':name_event',            $EventName,           \PDO::PARAM_STR);
        $UpdateEvent->bindParam(':begin_date',            $BeginDate,           \PDO::PARAM_STR);
        $UpdateEvent->bindParam(':end_date',              $EndDate,             \PDO::PARAM_STR);
        $UpdateEvent->bindParam(':description_event',     $EventDescription,    \PDO::PARAM_STR);
        $UpdateEvent->bindParam(':facebook_event_link',   $FacebookEventLink,   \PDO::PARAM_STR);
        $UpdateEvent->bindParam(':id_asso',               $IdAsso,              \PDO::PARAM_INT);
        $UpdateEvent->execute();
    }

    /**
     * Get one event if ID is given or all events
     *
     * @param int ID
     *
     * @return Array[mixed]
     */
    public function GetEvent(int $ID = null) {
        if ($ID !== null) {
            $GetEvent = $this->DB->prepare('SELECT * FROM events WHERE id_event = :id_event');
            $GetEvent->bindParam(':id_event', $ID, \PDO::PARAM_INT);
            $GetEvent->execute();
            $Event = $GetEvent->fetchAll();
            return (count($Event) > 0) ? $Event[0] : null;
        } else {
            $GetEvents = $this->DB->prepare('SELECT * FROM events');
            $GetEvents->execute();
            $Events = $GetEvents->fetchAll();
            return (count($Events) > 0) ? $Events : null;
        }
    }

    public function DeleteEvent(int $ID)
    {
        if ($ID !== null)
        {
            $DelEvent = $this->DB->prepare('DELETE FROM events WHERE id_event = :id_event');
            $DelEvent->bindParam('id_event', $ID, \PDO::PARAM_INT);
            $DelEvent->execute();
        }
    }


}
