<?php

$router->get('/', function ()
{
    require_once 'controllers/Home.controller.php';
    $HomePage = new \Controller\Home();
    $HomePage->RequireView();
});

$router->get('/home', function ()
{
    require_once 'controllers/Home.controller.php';
    $HomePage = new \Controller\Home();
    $HomePage->RequireView();
});

$router->get('/assos', function ()
{
    require_once 'controllers/Associations.controller.php';
    $AssosPage = new \Controller\Associations();
    $AssosPage->RequireView();
});

$router->get('/events', function ()
{
    require_once "controllers/Events.controller.php";
    $EventsPage = new \Controller\Events();
    $EventsPage->RequireView();
});

$router->get('/bde', function ()
{
    require_once "controllers/BDE.controller.php";
});

$router->get('/contact', function ()
{
    require_once "controllers/Contact.controller.php";
    $ContactPage = new \Controller\Contact();
    $ContactPage->RequireView();
});

$router->get('/login', function ()
{
    try
    {
        require_once('controllers/LogIn.controller.php');
        \Controller\LogIn::RequireView();
    }

    catch (\Exception $e)
    {
        require_once('controllers/Home.controller.php');
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});

$router->post('/login', function ()
{
    require_once "controllers/LogIn.controller.php";
    $LogIn = new \Controller\LogIn();
    $LogIn->ConnectAccount();
    $LogIn->RequireView($LogIn->GetMessage());
});

$router->get('/signup', function ()
{
    try {
        require_once "controllers/SignUp.controller.php";
        \Controller\SignUp::RequireView();
    }

    catch (\Exception $e)
    {
        require_once('controllers/Home.controller.php');
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});

$router->post('/signup', function ()
{
    require_once "controllers/SignUp.controller.php";
    try
    {
        $SignUp = new \Controller\SignUp();
        $SignUp->CreateAccount();
        $SignUp->RequireView($SignUp->GetMessage());
    }

    catch (\Exception $e)
    {
        \Controller\SignUp::RequireView($SignUp->GetMessage());
    }
});

$router->get('/logout', function ()
{
    session_destroy();
    header('Location: /');
});
