<?php

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
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
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
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
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
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
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
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
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
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
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
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
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
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});
