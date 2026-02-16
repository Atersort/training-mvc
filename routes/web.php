<?php
declare(strict_types=1);

use App\Controllers\HomeController;
use Symfony\Component\HttpFoundation\Response;
use App\Router\Route;

// Route->get('/', [HomeControllers::class, 'hello'])
return [
    Route::get('/', [dHomeController::class, 'hello']),
    Route::get('/post', [HomeController::class, 'post']),
    Route::get('/post/{id:\d+}', [HomeController::class, 'postById'])

//    ['GET', '/post', function () {
//        $content = 'Hello Post page';
//
//        return new Response($content);
//    }],
//
//    ['GET', '/post/{id:\d+}', function (array $vars) {
//        $content = "Hello Post page id: " . $vars['id'];
//
//        return new Response($content);
//    }]
];

