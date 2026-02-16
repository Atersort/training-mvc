<?php
declare(strict_types=1);

define('APP_PATH', dirname(__DIR__));

require_once APP_PATH . '/vendor/autoload.php';

use App\App;
use App\Router\Route;
use App\Router\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();

$router = new Router();

$app = new App($router);

$route = $app->handler($request);

$route->send();
