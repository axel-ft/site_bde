<?php

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
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
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
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
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
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
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
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
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
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});

$router->get('/manage/users/deactivate/:id', function($id)
{
    require_once "controllers/manage/ManageUsers.controller.php";
    try
    {
        $id = intval($id);
        $ManageUsers = new \Controller\ManageUsers();
        $ManageUsers->RequireView("Deactivate", null, $id);
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});

$router->post('/manage/users/deactivate/:id', function($id)
{
    require_once "controllers/manage/ManageUsers.controller.php";
    try
    {
        $id = intval($id);
        $ManageProfiles = new \Controller\ManageUsers();
        $ManageProfiles->DeactivateUser($id);
        $ManageProfiles->RequireView("List", null, $id);
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});
