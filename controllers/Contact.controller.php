<?php namespace Controller;

require_once "controllers/Common.controller.php";

class Contact extends CommonController
{

    public function __construct()
    {

    }

    public function RequireView(string $Message = null)
    {
        return require_once('views/Contact.view.php');
    }
}

?>
