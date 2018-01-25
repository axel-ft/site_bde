<?php

$router->get('/manage/categories', function()
{
    require_once "controllers/manage/ManageCategories.controller.php";
    try
    {
        $ManageCat = new \Controller\ManageCategories();
        $ManageCat->RequireView("List");
    }

    catch (Exception $e)
    {
        require_once "controllers/Home.controller.php";
        http_response_code(403);
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});

$router->get('/manage/categories/add', function()
{
    require_once "controllers/manage/ManageCategories.controller.php";
    try
    {
        $ManageCat = new \Controller\ManageCategories();
        $ManageCat->RequireView("Add");
    }

    catch (Exception $e)
    {
        require_once "controllers/Home.controller.php";
        http_response_code(403);
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});

$router->post('/manage/categories/add', function()
{
    require_once "controllers/manage/ManageCategories.controller.php";
    try
    {
        $ManageCat = new \Controller\ManageCategories();
        $ManageCat->AddCategory();
        $ManageCat->RequireView("List");
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});

$router->get('/manage/categories/edit/:id_cat', function($id_cat)
{
    require_once "controllers/manage/ManageCategories.controller.php";
    try
    {
        $id_cat = intval($id_cat);
        $ManageCat = new \Controller\ManageCategories();
        $ManageCat->RequireView("Edit", $id_cat);
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});

$router->post('/manage/categories/edit/:id_cat', function($id_cat)
{
    require_once "controllers/manage/ManageCategories.controller.php";
    try
    {
        $id_cat = intval($id_cat);
        $ManageCat = new \Controller\ManageCategories();
        $ManageCat->UpdateCategory($id_cat);
        $ManageCat->RequireView("Edit", $id_cat);
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});

$router->get('/manage/categories/delete/:id_cat', function($id_cat)
{
    require_once "controllers/manage/ManageCategories.controller.php";
    try
    {
        $id_cat = intval($id_cat);
        $ManageCat = new \Controller\ManageCategories();
        $ManageCat->RequireView("Delete", $id_cat);
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});

$router->post('/manage/categories/delete/:id_cat', function($id_cat)
{
    require_once "controllers/manage/ManageCategories.controller.php";
    try
    {
        $id_cat = intval($id_cat);
        $ManageCat = new \Controller\ManageCategories();
        $ManageCat->DeleteCategory($id_cat);
        $ManageCat->RequireView("List", $id_cat);
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});
