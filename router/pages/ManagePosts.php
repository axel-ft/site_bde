<?php

$router->get('/manage/posts', function()
{
    require_once "controllers/manage/ManagePosts.controller.php";
    try
    {
        $ManagePost = new \Controller\ManagePosts();
        $ManagePost->RequireView("List");
    }

    catch (Exception $e)
    {
        require_once "controllers/Home.controller.php";
        http_response_code(403);
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});

$router->get('/manage/posts/add', function()
{
    require_once "controllers/manage/ManagePosts.controller.php";
    try
    {
        $ManagePost = new \Controller\ManagePosts();
        $ManagePost->RequireView("Add");
    }

    catch (Exception $e)
    {
        require_once "controllers/Home.controller.php";
        http_response_code(403);
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});

$router->post('/manage/posts/add', function()
{
    require_once "controllers/manage/ManagePosts.controller.php";
    try
    {
        $ManagePost = new \Controller\ManagePosts();
        $ManagePost->AddPost();
        $ManagePost->RequireView("List");
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});

$router->get('/manage/posts/edit/:post', function($post)
{
    require_once "controllers/manage/ManagePosts.controller.php";
    try
    {
        $post = intval($post);
        $ManagePost = new \Controller\ManagePosts();
        $ManagePost->RequireView("Edit", $post);
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});

$router->post('/manage/posts/edit/:post', function($post)
{
    require_once "controllers/manage/ManagePosts.controller.php";
    try
    {
        $post = intval($post);
        $ManagePost = new \Controller\ManagePosts();
        $ManagePost->UpdatePost($post);
        $ManagePost->RequireView("Edit", $post);
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});

$router->get('/manage/posts/delete/:post', function($post)
{
    require_once "controllers/manage/ManagePosts.controller.php";
    try
    {
        $post = intval($post);
        $ManagePost = new \Controller\ManagePosts();
        $ManagePost->RequireView("Delete", $post);
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});

$router->post('/manage/posts/delete/:post', function($post)
{
    require_once "controllers/manage/ManagePosts.controller.php";
    try
    {
        $post = intval($post);
        $ManagePost = new \Controller\ManagePosts();
        $ManagePost->DeletePost($post);
        $ManagePost->RequireView("List", $post);
    }

    catch (Exception $e)
    {
        require_once"controllers/Home.controller.php";
        http_response_code(403);
        $Home = new \Controller\Home();
        $Home->RequireView($e->getMessage());
    }
});
