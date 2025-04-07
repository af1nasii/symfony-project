<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class MessageDTO
{
    #[Assert\NotBlank(message: "Сообщение не может быть пустым")]
    public string $content;
}