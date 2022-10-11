<?php

namespace App\Entity;

use App\Repository\QuizzRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuizzRepository::class)]
class Quizz
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $theme = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $difficulty = null;

    #[ORM\ManyToOne(inversedBy: 'quizzList')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Player $quizzFounder = null;

    #[ORM\OneToMany(mappedBy: 'quizz', targetEntity: Play::class)]
    private Collection $playList;

    #[ORM\OneToMany(mappedBy: 'quizz', targetEntity: Questions::class)]
    private Collection $questionsList;

    public function __construct()
    {
        $this->playList = new ArrayCollection();
        $this->questionsList = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(string $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    public function getDifficulty(): ?int
    {
        return $this->difficulty;
    }

    public function setDifficulty(int $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getQuizzFounder(): ?Player
    {
        return $this->quizzFounder;
    }

    public function setQuizzFounder(?Player $quizzFounder): self
    {
        $this->quizzFounder = $quizzFounder;

        return $this;
    }

    /**
     * @return Collection<int, Play>
     */
    public function getPlayList(): Collection
    {
        return $this->playList;
    }

    public function addPlayList(Play $playList): self
    {
        if (!$this->playList->contains($playList)) {
            $this->playList->add($playList);
            $playList->setQuizz($this);
        }

        return $this;
    }

    public function removePlayList(Play $playList): self
    {
        if ($this->playList->removeElement($playList)) {
            // set the owning side to null (unless already changed)
            if ($playList->getQuizz() === $this) {
                $playList->setQuizz(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Questions>
     */
    public function getQuestionsList(): Collection
    {
        return $this->questionsList;
    }

    public function addQuestionsList(Questions $questionsList): self
    {
        if (!$this->questionsList->contains($questionsList)) {
            $this->questionsList->add($questionsList);
            $questionsList->setQuizz($this);
        }

        return $this;
    }

    public function removeQuestionsList(Questions $questionsList): self
    {
        if ($this->questionsList->removeElement($questionsList)) {
            // set the owning side to null (unless already changed)
            if ($questionsList->getQuizz() === $this) {
                $questionsList->setQuizz(null);
            }
        }

        return $this;
    }
}
