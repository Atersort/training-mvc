<?php
declare(strict_types=1);


namespace App\Controllers;

use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    public function hello(): Response
    {
        $content = "Hello Home page";

        return new Response($content);
    }

    public function post(): Response
    {
        $content = "Hello main post page";

        return new Response($content);
    }

    public function postById(array $vars): Response
    {
        $content = "Hello post id {$vars['id']}";

        return new Response($content);
    }

}