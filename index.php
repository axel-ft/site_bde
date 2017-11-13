<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('router/Router.class.php');
require_once('router/Route.class.php');
require_once('router/RouterException.class.php');

use \Router\Router as Router;

$router = new Router($_GET['url']);

$router->get('/', function ()
{
    require_once 'controllers/Home.controller.php';
    \Controller\Home::RequireView();
});

$router->get('/home', function ()
{
    require_once 'controllers/Home.controller.php';
    \Controller\Home::RequireView();
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
    try
    {
        require_once('controllers/LogIn.controller.php');
        \Controller\LogIn::RequireView();
    }

    catch (Exception $e)
    {
        require_once('controllers/Home.controller.php');
        \Controller\Home::RequireView($e->getMessage());
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

$router->get('/myprofile', function()
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
        http_response_code(403);
        \Controller\LogIn::RequireView($e->getMessage());
    }
});

$router->post('/myprofile', function()
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
        http_response_code(403);
        \Controller\LogIn::RequireView($e->getMessage());
    }
});

$router->post('/deactivate', function()
{
    require_once "controllers/Profile.controller.php";
    require_once "controllers/Home.controller.php";
    try
    {
        $Profile = new \Controller\Profile();
        if($Profile->DeactivateAccount())
            require_once "controllers/Home.controller.php";
        else
            $Profile->RequireView();
        \Controller\Home::RequireView($Profile->GetMessage());
    }

    catch (Exception $e)
    {
        require_once "controllers/LogIn.controller.php";
        http_response_code(403);
        \Controller\LogIn::RequireView($e->getMessage());
    }
});

$router->get('/manage/assos', function()
{
    require_once "controllers/manage/ManageAssos.controller.php";
    try
    {
        $ManageAssos = new \Controller\ManageAssos();
        $ManageAssos->RequireView("List");
    }

    catch (Exception $e)
    {
        require_once "controllers/Home.controller.php";
        http_response_code(403);
        \Controller\Home::RequireView($e->getMessage());
    }
});

$router->get('/manage/assos/add', function()
{
    require_once "controllers/manage/ManageAssos.controller.php";
    try
    {
        $ManageAssos = new \Controller\ManageAssos();
        $ManageAssos->RequireView("Add");
    }

    catch (Exception $e)
    {
        require_once "controllers/Home.controller.php";
        http_response_code(403);
        \Controller\Home::RequireView($e->getMessage());
    }
});

$router->post('/manage/assos/add', function()
{
    require_once "controllers/manage/ManageAssos.controller.php";
    try
    {
        $ManageAssos = new \Controller\ManageAssos();
        $ManageAssos->AddAsso();
        $ManageAssos->RequireView("List", $ManageAssos->GetMessage());
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        \Controller\Home::RequireView($e->getMessage());
    }
});

$router->get('/manage/assos/edit/:id', function($id)
{
    require_once "controllers/manage/ManageAssos.controller.php";
    try
    {
        $id = intval($id);
        $ManageAssos = new \Controller\ManageAssos();
        $ManageAssos->RequireView("Edit", null, $id);
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        \Controller\Home::RequireView($e->getMessage());
    }
});

$router->post('/manage/assos/edit/:id', function($id)
{
    require_once "controllers/manage/ManageAssos.controller.php";
    try
    {
        $id = intval($id);
        $ManageAssos = new \Controller\ManageAssos();
        $ManageAssos->UpdateAsso($id);
        $ManageAssos->RequireView("Edit", null, $id);
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        \Controller\Home::RequireView($e->getMessage());
    }
});

$router->get('/manage/assos/delete/:id', function($id)
{
    require_once "controllers/manage/ManageAssos.controller.php";
    try
    {
        $id = intval($id);
        $ManageAssos = new \Controller\ManageAssos();
        $ManageAssos->RequireView("Delete", null, $id);
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        \Controller\Home::RequireView($e->getMessage());
    }
});

$router->post('/manage/assos/delete/:id', function($id)
{
    require_once "controllers/manage/ManageAssos.controller.php";
    try
    {
        $id = intval($id);
        $ManageAssos = new \Controller\ManageAssos();
        $ManageAssos->DeleteAsso($id);
        $ManageAssos->RequireView("List", null, $id);
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        \Controller\Home::RequireView($e->getMessage());
    }
});

$router->get('/manage/profiles', function()
{
    require_once "controllers/manage/ManageProfiles.controller.php";
    try
    {
        $ManageProfiles = new \Controller\ManageProfiles();
        $ManageProfiles->RequireView("List");
    }

    catch (Exception $e)
    {
        require_once "controllers/Home.controller.php";
        http_response_code(403);
        \Controller\Home::RequireView($e->getMessage());
    }
});

$router->get('/manage/profiles/add', function()
{
    require_once "controllers/manage/ManageProfiles.controller.php";
    try
    {
        $ManageProfiles = new \Controller\ManageProfiles();
        $ManageProfiles->RequireView("Add");
    }

    catch (Exception $e)
    {
        require_once "controllers/Home.controller.php";
        http_response_code(403);
        \Controller\Home::RequireView($e->getMessage());
    }
});

$router->post('/manage/profiles/add', function()
{
    require_once "controllers/manage/ManageProfiles.controller.php";
    try
    {
        $ManageProfiles = new \Controller\ManageProfiles();
        $ManageProfiles->AddProfile();
        $ManageProfiles->RequireView("List");
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        \Controller\Home::RequireView($e->getMessage());
    }
});

$router->get('/manage/profiles/edit/:id', function($id)
{
    require_once "controllers/manage/ManageProfiles.controller.php";
    try
    {
        $id = intval($id);
        $ManageProfiles = new \Controller\ManageProfiles();
        $ManageProfiles->RequireView("Edit", null, $id);
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        \Controller\Home::RequireView($e->getMessage());
    }
});

$router->post('/manage/profiles/edit/:id', function($id)
{
    require_once "controllers/manage/ManageProfiles.controller.php";
    try
    {
        $id = intval($id);
        $ManageProfiles = new \Controller\ManageProfiles();
        $ManageProfiles->UpdateProfile($id);
        $ManageProfiles->RequireView("Edit", null, $id);
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        \Controller\Home::RequireView($e->getMessage());
    }
});

$router->get('/manage/profiles/delete/:id', function($id)
{
    require_once "controllers/manage/ManageProfiles.controller.php";
    try
    {
        $id = intval($id);
        $ManageProfiles = new \Controller\ManageProfiles();
        if ($ManageProfiles->DeleteProfile($id, true))
            $ManageProfiles->RequireView("Delete", null, $id);
        else
            $ManageProfiles->RequireView("Hide", null, $id);
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        \Controller\Home::RequireView($e->getMessage());
    }
});

$router->post('/manage/profiles/delete/:id', function($id)
{
    require_once "controllers/manage/ManageProfiles.controller.php";
    try
    {
        $id = intval($id);
        $ManageProfiles = new \Controller\ManageProfiles();
        $ManageProfiles->DeleteProfile($id);
        $ManageProfiles->RequireView("List", null, $id);
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        \Controller\Home::RequireView($e->getMessage());
    }
});







$router->get('/manage/users', function()
{
    require_once "controllers/manage/ManageUsers.controller.php";
    try
    {
        $ManageUsers = new \Controller\ManageUsers();
        $ManageUsers->RequireView("List");
    }

    catch (Exception $e)
    {
        require_once "controllers/Home.controller.php";
        http_response_code(403);
        \Controller\Home::RequireView($e->getMessage());
    }
});

$router->get('/manage/users/add', function()
{
    require_once "controllers/manage/ManageUsers.controller.php";
    try
    {
        $ManageUsers = new \Controller\ManageUsers();
        $ManageUsers->RequireView("Add");
    }

    catch (Exception $e)
    {
        require_once "controllers/Home.controller.php";
        http_response_code(403);
        \Controller\Home::RequireView($e->getMessage());
    }
});

$router->post('/manage/users/add', function()
{
    require_once "controllers/manage/ManageUsers.controller.php";
    try
    {
        $ManageUsers = new \Controller\ManageUsers();
        $ManageUsers->AddUser();
        $ManageUsers->RequireView("List");
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        \Controller\Home::RequireView($e->getMessage());
    }
});

$router->get('/manage/users/edit/:id', function($id)
{
    require_once "controllers/manage/ManageUsers.controller.php";
    try
    {
        $id = intval($id);
        $ManageUsers = new \Controller\ManageUsers();
        $ManageUsers->RequireView("Edit", null, $id);
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        \Controller\Home::RequireView($e->getMessage());
    }
});

$router->post('/manage/users/edit/:id', function($id)
{
    require_once "controllers/manage/ManageUsers.controller.php";
    try
    {
        $id = intval($id);
        $ManageUsers = new \Controller\ManageUsers();
        $ManageUsers->UpdateUser($id);
        $ManageUsers->RequireView("Edit", null, $id);
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        \Controller\Home::RequireView($e->getMessage());
    }
});

$router->get('/manage/users/delete/:id', function($id)
{
    require_once "controllers/manage/ManageUsers.controller.php";
    try
    {
        $id = intval($id);
        $ManageUsers = new \Controller\ManageUsers();
        $ManageUsers->RequireView("Delete", null, $id);
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        \Controller\Home::RequireView($e->getMessage());
    }
});

$router->post('/manage/users/delete/:id', function($id)
{
    require_once "controllers/manage/ManageUsers.controller.php";
    try
    {
        $id = intval($id);
        $ManageProfiles = new \Controller\ManageUsers();
        $ManageProfiles->DeleteUser($id);
        $ManageProfiles->RequireView("List", null, $id);
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        \Controller\Home::RequireView($e->getMessage());
    }
});










try
{
    $router->run();
}

catch (RouterException $e)
{
    require_once "controllers/404.controller.php";
    http_response_code(404);
    \Controller\NotFound::RequireView();
}
