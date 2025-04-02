<?php

namespace App\Controller;

use App\Entity\Message;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ForumController extends AbstractController
{
    #[Route('/forum', name: 'forum_list', methods: ['GET'])]
    public function list(EntityManagerInterface $entityManager): Response
    {
        $messages = $entityManager->getRepository(Message::class)->findBy([], ['id' => 'DESC']);
        return $this->render('list.html.twig', [
            'messages' => $messages,
        ]);
    }

    #[Route('/forum/post', name: 'forum_post', methods: ['POST'])]
    public function postMessage(Request $request, EntityManagerInterface $entityManager): Response
    {
        $content = trim($request->request->get('content'));
        if (!empty($content)) {
            $message = new Message();
            $message->setContent($content);
            $entityManager->persist($message);
            $entityManager->flush();
        }
        return $this->redirectToRoute('forum_list');
    }
}
