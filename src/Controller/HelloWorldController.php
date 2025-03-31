<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HelloWorldController extends AbstractController
{
    #[Route('hello-world')]
    public function number(): Response
    {
        $hello = 'Hello World!';
        return $this->render('HelloWorld.html.twig', [
            'hello' => $hello,]);
    }
}

