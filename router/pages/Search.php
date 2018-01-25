<?php

$router->get('/search', function ()
{
    require_once 'controllers/Search.controller.php';
    $SearchPage = new \Controller\Search();
    $SearchPage->RequireView("NoQuery");
});

$router->post('/search', function ()
{
    require_once 'controllers/Search.controller.php';
    try
    {
        $SearchProcessPage = new \Controller\Search();
        $SearchProcessPage->ProcessPostQuerySearch();
    }

    catch (\Exception $e)
    {
        $SearchPage = new \Controller\Search();
        $SearchPage->RequireView("NoQuery", $e->getMessage());
    }
});

$router->get('/search/:query', function ($query)
{
    require_once 'controllers/Search.controller.php';
    try
    {
        $SearchResultsPage = new \Controller\Search($query);
        $SearchResultsPage->ProcessGetQuerySearch();
        $SearchResultsPage->GetSearchResults("Full");
        $SearchResultsPage->RequireView("Results");
    }

    catch (\Exception $e)
    {
        $SearchPage = new \Controller\Search();
        $SearchPage->RequireView("NoQuery", $e->getMessage());
    }
});
