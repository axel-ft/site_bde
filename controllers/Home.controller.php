<?php namespace Controller;

require_once "controllers/Common.controller.php";
require_once "models/Post.model.php";
require_once "models/Events.class.php";

class Home extends CommonController
{
    private $EventsQueries,
            $PostsQueries;

    public function __construct()
    {
        $this->EventsQueries = new \Model\Event();
        $this->PostsQueries = new\Model\Post();
    }

    public function RequireView(string $Message = null)
    {
        $Events = (!is_null($this->EventsQueries->GetEvent())) ? self::ConstructDateTimes($this->EventsQueries->GetEvent(), array('begin_date', 'end_date')) : null;
        $Posts = (!is_null($this->PostsQueries->GetPost())) ? self::ConstructDateTimes($this->PostsQueries->GetPost(), array('publish_date', 'edited_date')) : null;

        return require_once('views/Home.view.php');
    }
}

?>
