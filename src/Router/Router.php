<?php
declare(strict_types=1);


namespace App\Router;


use App\Exception\HttpException;
use FastRoute\Dispatcher;
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

        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                throw new HttpException('404 Not Found', 404);
            case Dispatcher::FOUND:
                [$status, [$controller, $method], $vars] = $routeInfo;
            case Dispatcher::METHOD_NOT_ALLOWED:
                throw new HttpException('405 Method Not Allowed', 405);
        }

        [$status, [$controller, $method], $vars] = $routeInfo;


        return [[$controller, $method], $vars];
    }

}