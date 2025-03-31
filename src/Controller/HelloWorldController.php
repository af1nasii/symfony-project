<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HelloWorldController
{
    #[Route('hello-world')]
    public function number(): Response
    {
        return new Response(
            '<html><body align = center>Hello World!</body></html>'
        );
    }
}

