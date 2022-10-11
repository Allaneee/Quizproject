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

    #[ORM\ManyToOne(inversedBy: 'answerList')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Questions $question = null;

    #[ORM\ManyToOne(inversedBy: 'answerList')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Player $player = null;

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

    public function getQuestion(): ?Questions
    {
        return $this->question;
    }

    public function setQuestion(?Questions $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

        return $this;
    }
}
