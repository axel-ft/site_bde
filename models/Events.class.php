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
        $DB = DataBaseAccess::getInstance();
    }

    /**
     * Creates a new event
     *
     */
    public function NewEvent()
    {
        $Event = $DB->prepare('INSERT INTO events(name_event, begin_date, end_date, description, facebook_event_link, id_asso)
                                VALUES (:name_event, :begin_date, :end_date, :description, :facebook_event_link, :id_asso)');
        $Event->bindParam(':name_event',            $_POST['name_event'],           PDO::PARAM_STR);
        $Event->bindParam(':begin_date',            $_POST['begin_date'],           PDO::PARAM_STR);
        $Event->bindParam(':end_date',              $_POST['end_date'],             PDO::PARAM_STR);
        $Event->bindParam(':description',           $_POST['description'],          PDO::PARAM_STR);
        $Event->bindParam(':facebook_event_link',   $_POST['facebook_event_link'],  PDO::PARAM_STR);
        $Event->bindParam(':id_asso',               intval($_POST['id_asso']),      PDO::PARAM_INT);
        $Event->execute();
    }

    /**
     * Updates a existing event
     *
     */
    public function UpdateEvent($ID)
    {
        $UpdateEvent = $DB->prepare('UPDATE events SET name_event = :name_event, begin_date = :begin_date, end_date = :end_date, description = :description, facebook_event_link = :facebook_event_link, id_asso = :id_asso WHERE id_event = :id_event');
        $UpdateEvent->bindParam(':id_event',              intval($ID),                    PDO::PARAM_INT);
        $UpdateEvent->bindParam(':name_event',            $_POST['name_event'],           PDO::PARAM_STR);
        $UpdateEvent->bindParam(':begin_date',            $_POST['begin_date'],           PDO::PARAM_STR);
        $UpdateEvent->bindParam(':end_date',              $_POST['end_date'],             PDO::PARAM_STR);
        $UpdateEvent->bindParam(':description',           $_POST['description'],          PDO::PARAM_STR);
        $UpdateEvent->bindParam(':facebook_event_link',   $_POST['facebook_event_link'],  PDO::PARAM_STR);
        $UpdateEvent->bindParam(':id_asso',               intval($_POST['id_asso']),      PDO::PARAM_INT);
        $UpdateEvent->execute();
    }

    /**
     * Get one event if ID is given or all events
     *
     * @param int ID
     *
     * @return Array[mixed]
     */
    public function GetEvents($ID = null) {
        if ($ID !== null) {
            $GetEvent = $DB->prepare('SELECT * FROM events WHERE id_event = :id_event');
            $GetEvent->bindParam(':id_event', intval($ID), PDO::PARAM_INT);
            $GetEvent->execute();
            $Event = $GetEvent->fetchAll();
            return (count($Event) > 0) ? $Event : null;
        } else {
            $GetEvents = $DB->prepare('SELECT * FROM events');
            $GetEvents->execute();
            $Events = $GetEvents->fetchAll();
            return (count($Events) > 0) ? $Events : null;;
        }
    }

    public function DeleteEvent($ID)
    {
        if ($ID !== null)
        {
            $DelEvent = $DB->prepare('DELETE FROM events WHERE id_event = :id_event');
            $DelEvent->bindParam('id_event', intval($ID), PDO::PARAM_INT);
            $DelEventsso->execute();
        }
    }


}
