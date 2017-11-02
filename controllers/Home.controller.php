<?php namespace Controller;

class Home
{
    public function __construct()
    {

    }

    public static function RequireView(string $Message = null)
    {
        return require_once('views/Home.view.php');
    }
}

?>
