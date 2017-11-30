<?php

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
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
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
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
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
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
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
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
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
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
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
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
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
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});
