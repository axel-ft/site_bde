<?php

$router->get('/manage/events', function()
{
    require_once "controllers/manage/ManageEvents.controller.php";
    try
    {
        $ManageEvents = new \Controller\ManageEvents();
        $ManageEvents->RequireView("List");
    }

    catch (Exception $e)
    {
        require_once "controllers/Home.controller.php";
        http_response_code(403);
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});

$router->get('/manage/events/add', function()
{
    require_once "controllers/manage/ManageEvents.controller.php";
    try
    {
        $ManageEvents = new \Controller\ManageEvents();
        $ManageEvents->RequireView("Add");
    }

    catch (Exception $e)
    {
        require_once "controllers/Home.controller.php";
        http_response_code(403);
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});

$router->post('/manage/events/add', function()
{
    require_once "controllers/manage/ManageEvents.controller.php";
    try
    {
        $ManageEvents = new \Controller\ManageEvents();
        $ManageEvents->AddEvent();
        $ManageEvents->RequireView("List");
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});

$router->get('/manage/events/edit/:id', function($id)
{
    require_once "controllers/manage/ManageEvents.controller.php";
    try
    {
        $id = intval($id);
        $ManageEvents = new \Controller\ManageEvents();
        $ManageEvents->RequireView("Edit", null, $id);
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});

$router->post('/manage/events/edit/:id', function($id)
{
    require_once "controllers/manage/ManageEvents.controller.php";
    try
    {
        $id = intval($id);
        $ManageEvents = new \Controller\ManageEvents();
        $ManageEvents->UpdateEvent($id);
        $ManageEvents->RequireView("Edit", null, $id);
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});

$router->get('/manage/events/delete/:id', function($id)
{
    require_once "controllers/manage/ManageEvents.controller.php";
    try
    {
        $id = intval($id);
        $ManageEvents = new \Controller\ManageEvents();
        $ManageEvents->RequireView("Delete", null, $id);
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});

$router->post('/manage/events/delete/:id', function($id)
{
    require_once "controllers/manage/ManageEvents.controller.php";
    try
    {
        $id = intval($id);
        $ManageEvents = new \Controller\ManageEvents();
        $ManageEvents->DeleteEvent($id);
        $ManageEvents->RequireView("List", null, $id);
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});
