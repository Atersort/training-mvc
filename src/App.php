<?php
declare(strict_types=1);

namespace App;

use App\Router\Router;
use FastRoute\RouteCollector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use function FastRoute\simpleDispatcher;

class App
{

    public function __construct(private Router $router)
    {
    }

    public function handler(Request $request): Response
    {
        //[$routehandler, $vars] = this->router->dispatch($request)
        // $response = call_user_func_array($routeHandler, $vars)

        try {
            [[$controller, $method], $vars] = $this->router->dispatcher($request);

            $responce = call_user_func([new $controller, $method], $vars);
        } catch (\Throwable $exception) {
            $response = new Response($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $responce;
    }


}