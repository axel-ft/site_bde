<?php
session_start();
setlocale(LC_TIME, "fr_FR.UTF-8");
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('router/Router.class.php');
require_once('router/Route.class.php');
require_once('router/RouterException.class.php');

use \Router\Router as Router;

$router = new Router($_GET['url']);

require_once('router/pages/Front.php');
require_once('router/pages/MyAccount.php');
require_once('router/pages/ManageAssos.php');
require_once('router/pages/ManageProfiles.php');
require_once('router/pages/ManageUsers.php');
require_once('router/pages/ManageEvents.php');

try
{
    $router->run();
}

catch (\Router\RouterException $e)
{
    require_once "controllers/404.controller.php";
    http_response_code(404);
    \Controller\NotFound::RequireView();
}
