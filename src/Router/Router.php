<?php
declare(strict_types=1);


namespace App\Router;


use FastRoute\RouteCollector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use function FastRoute\simpleDispatcher;

class Router
{
    public function dispatcher(Request $request): array
    {
        $dispatcher = simpleDispatcher(function (RouteCollector $collector) {
            $routes = require_once APP_PATH . '/routes/web.php';

            foreach ($routes as $route) {
                $collector->addRoute(...$route);
            }
        });

        $method = $request->getMethod();
        $uri = $request->getPathInfo();

        $routeInfo = $dispatcher->dispatch($method, $uri);

        [$status, [$controller, $method], $vars] = $routeInfo;

        return [[$controller, $method], $vars];
    }

}