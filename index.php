<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('router/Router.class.php');
require_once('router/Route.class.php');
require_once('router/RouterException.class.php');

$router = new Router($_GET['url']);

$router->get('/', function ()
{
    require_once 'controllers/Home.controller.php';
});

$router->get('/home', function ()
{
    require_once 'controllers/Home.controller.php';
});

$router->get('/assos', function ()
{
    require_once 'controllers/Associations.controller.php';
});

$router->get('/events', function ()
{
    require_once "controllers/Events.controller.php";
});

$router->get('/bde', function ()
{
    require_once "controllers/BDE.controller.php";
});

$router->get('/contact', function ()
{
    require_once "controllers/Contact.controller.php";
});

$router->get('/login', function ()
{
    require_once('controllers/LogIn.controller.php');
    \Controller\LogIn::RequireView();
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
    require_once "controllers/SignUp.controller.php";
    \Controller\SignUp::RequireView();
});

$router->post('/signup', function ()
{
    require_once "controllers/SignUp.controller.php";
    $SignUp = new \Controller\SignUp();
    $SignUp->CreateAccount();
    $SignUp->RequireView($SignUp->GetMessage());
});

$router->get('/logout', function ()
{
    session_destroy();
    header('Location: /');
    //require_once "controllers/LogOut.controller.php";
});

$router->get('/profile', function()
{
    require_once "controllers/Profile.controller.php";
    try
    {
        $Profile = new \Controller\Profile();
        $Profile->RequireView();
    }

    catch (Exception $e)
    {
        require_once "controllers/LogIn.controller.php";
        \Controller\LogIn::RequireView($e->getMessage());
    }
});

$router->post('/profile', function()
{
    require_once "controllers/Profile.controller.php";
    try
    {
        $Profile = new \Controller\Profile();
        $AccountAndProfile = $Profile->GetAccountAndProfile();
        $Profile->UpdateAccount();
        $AccountAndProfile = $Profile->GetAccountAndProfile();
        $Profile->RequireView();
    }

    catch (Exception $e)
    {
        require_once "controllers/LogIn.controller.php";
        \Controller\LogIn::RequireView($e->getMessage());
    }
});

$router->post('/deactivate', function()
{
    require_once "controllers/Profile.controller.php";
    //require_once "controllers/Home.controller.php";
    try
    {
        $Profile = new \Controller\Profile();
        if($Profile->DeactivateAccount())
            require_once "controllers/Home.controller.php";
        else
            $Profile->RequireView();
        //\Controller\Home::RequireView($Profile->GetMessage);
    }

    catch (Exception $e)
    {
        require_once "controllers/LogIn.controller.php";
        \Controller\LogIn::RequireView($e->getMessage());
    }
});

try
{
    $router->run();
}

catch (RouterException $e)
{
    require_once "controllers/404.controller.php";
    \Controller\NotFound::RequireView();
}
