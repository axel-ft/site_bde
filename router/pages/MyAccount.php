<?php

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
        $LogIn = new \Controller\LogIn();
        $LogIn->RequireView($e->getMessage());
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
        $LogIn = new \Controller\LogIn();
        $LogIn->RequireView($e->getMessage());
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
        $Home = new \Controller\Home();
        $Home->RequireView($Profile->getMessage());
    }

    catch (Exception $e)
    {
        require_once "controllers/LogIn.controller.php";
        http_response_code(403);
        $LogIn = new \Controller\LogIn();
        $LogIn->RequireView($e->getMessage());
    }
});
