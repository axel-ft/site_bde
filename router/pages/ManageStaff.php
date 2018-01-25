<?php

$router->get('/manage/staff', function()
{
    require_once "controllers/manage/ManageStaff.controller.php";
    try
    {
        $ManageAssos = new \Controller\ManageStaff();
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

$router->get('/manage/staff/:asso', function($asso)
{
    require_once "controllers/manage/ManageStaff.controller.php";
    try
    {
        $asso = intval($asso);
        $ManageAssos = new \Controller\ManageStaff();
        $ManageAssos->RequireView("List", $asso);
    }

    catch (Exception $e)
    {
        require_once "controllers/Home.controller.php";
        http_response_code(403);
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});

$router->get('/manage/staff/:asso/add', function($asso)
{
    require_once "controllers/manage/ManageStaff.controller.php";
    try
    {
        $asso = intval($asso);
        $ManageAssos = new \Controller\ManageStaff();
        $ManageAssos->RequireView("Add", $asso);
    }

    catch (Exception $e)
    {
        require_once "controllers/Home.controller.php";
        http_response_code(403);
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});

$router->post('/manage/staff/:asso/add', function($asso)
{
    require_once "controllers/manage/ManageStaff.controller.php";
    try
    {
        $asso = intval($asso);
        $ManageStaff = new \Controller\ManageStaff();
        $ManageStaff->AddStaff($asso);
        $ManageStaff->RequireView("List", $asso, null, $ManageStaff->GetMessage());
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});

$router->get('/manage/staff/:asso/edit/:profile', function($asso, $profile)
{
    require_once "controllers/manage/ManageStaff.controller.php";
    try
    {
        $asso = intval($asso);
        $profile = intval($profile);
        $ManageStaff = new \Controller\ManageStaff();
        $ManageStaff->RequireView("Edit", $asso, $profile);
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});

$router->post('/manage/staff/:asso/edit/:profile', function($asso, $profile)
{
    require_once "controllers/manage/ManageStaff.controller.php";
    try
    {
        $asso = intval($asso);
        $profile = intval($profile);
        $ManageStaff = new \Controller\ManageStaff();
        $ManageStaff->UpdateStaff($asso, $profile);
        $ManageStaff->RequireView("Edit", $asso, $profile);
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});

$router->get('/manage/staff/:asso/delete/:profile', function($asso, $profile)
{
    require_once "controllers/manage/ManageStaff.controller.php";
    try
    {
        $asso = intval($asso);
        $profile = intval($profile);
        $ManageStaff = new \Controller\ManageStaff();
        $ManageStaff->RequireView("Delete", $asso, $profile);
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});

$router->post('/manage/staff/:asso/delete/:profile', function($asso, $profile)
{
    require_once "controllers/manage/ManageStaff.controller.php";
    try
    {
        $asso = intval($asso);
        $profile = intval($profile);
        $ManageStaff = new \Controller\ManageStaff();
        $ManageStaff->DeleteMember($asso, $profile);
        $ManageStaff->RequireView("List");
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});
