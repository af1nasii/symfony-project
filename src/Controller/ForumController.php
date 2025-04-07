<?php

namespace App\Controller;

use App\Factory\MessageFactory;
use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use App\DTO\MessageDTO;


class ForumController extends AbstractController
{
    private MessageRepository $messageRepository;
    private MessageFactory $messageFactory;

    public function __construct(MessageRepository $messageRepository, MessageFactory $messageFactory)
    {
        $this->messageRepository = $messageRepository;
        $this->messageFactory = $messageFactory;
    }


    #[Route('/forum', name: 'forum_list', methods: ['GET'])]

    public function list(): Response
    {
        $messages = $this->messageRepository->findBy([], ['id' => 'DESC']);

        return $this->render('list.html.twig', [
            'messages' => $messages,
        ]);
    }

    #[Route('/forum/post', name: 'forum_post', methods: ['POST'])]
    public function postMessage(
        #[MapRequestPayload] MessageDTO $dto,
        ValidatorInterface $validator
    ): Response {
        $errors = $validator->validate($dto);

        if (count($errors) > 0) {
            return $this->render('forum/list.html.twig', [
                'errors' => $errors,
            ]);
        }

        $message = $this->messageFactory->create($dto->content);
        $this->messageRepository->save($message, true);

        return $this->redirectToRoute('forum_list');
    }
}

