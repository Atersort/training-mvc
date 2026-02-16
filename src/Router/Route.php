<?php
declare(strict_types=1);


namespace App\Router;

use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Route
{
    public static function get(string $path, array $handler): array
    {
        return ['GET', $path, [$handler[0], $handler[1]]];
    }

    public static function post(string $path, $controller, $action): array
    {
        return ['GET', $path, [$controller, $action]];
    }
}