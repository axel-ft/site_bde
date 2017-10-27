<?php namespace Controller;

class NotFound
{
    public function __construct()
    {

    }

    public static function RequireView(string $Message = null)
    {
        return require_once 'views/404.view.php';
    }
}

?>
