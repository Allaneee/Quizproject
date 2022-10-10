<?php

namespace App\Entity;

use App\Repository\AnswerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnswerRepository::class)]
class Answer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $AnswerUser = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnswerUser(): ?string
    {
        return $this->AnswerUser;
    }

    public function setAnswerUser(string $AnswerUser): self
    {
        $this->AnswerUser = $AnswerUser;

        return $this;
    }
}
