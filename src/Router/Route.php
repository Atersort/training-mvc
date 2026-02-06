<?php
declare(strict_types=1);


namespace App\Router;

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Route
{
    public static function handler(Request $request): Response
    {
        $dispatcher = simpleDispatcher(function (RouteCollector $collector) {
            $collector->get('/', function () {
                $content = 'Hello, World!';

                return new Response($content);
            });

            $collector->addGroup('/posts', function (RouteCollector $group) {
                // Маршрут: /post (список всех постов)
                $group->get('', function () {
                    $content = 'Список всех постов';

                    return new Response($content);
                });

                // Маршрут: /post/{id} (конкретный пост)
                $group->get('/{id:\d+}', function (array $vars) {
                    $content = "Просмотр поста с ID: " . $vars['id'];

                    return new Response($content);
                });
            });
        });

        $httpMethod = $request->getMethod();
        $uri = $request->getPathInfo();
        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);

        [$status, $handler, $vars] = $routeInfo;

//        dd($status, $handler, $vars);

        return $handler($vars);
    }
}