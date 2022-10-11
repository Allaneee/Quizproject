<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
class Player
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Pseudo = null;

    #[ORM\Column(length: 255)]
    private ?string $role = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $themePref = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\OneToMany(mappedBy: 'quizzFounder', targetEntity: Quizz::class)]
    private Collection $quizzList;

    #[ORM\OneToMany(mappedBy: 'player', targetEntity: Play::class)]
    private Collection $scoreList;

    #[ORM\OneToMany(mappedBy: 'player', targetEntity: Answer::class, orphanRemoval: true)]
    private Collection $answerList;

    public function __construct()
    {
        $this->quizzList = new ArrayCollection();
        $this->scoreList = new ArrayCollection();
        $this->answerList = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->Pseudo;
    }

    public function setPseudo(string $Pseudo): self
    {
        $this->Pseudo = $Pseudo;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getThemePref(): ?string
    {
        return $this->themePref;
    }

    public function setThemePref(string $themePref): self
    {
        $this->themePref = $themePref;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    /**
     * @return Collection<int, Quizz>
     */
    public function getQuizzList(): Collection
    {
        return $this->quizzList;
    }

    public function addQuizzList(Quizz $quizzList): self
    {
        if (!$this->quizzList->contains($quizzList)) {
            $this->quizzList->add($quizzList);
            $quizzList->setQuizzFounder($this);
        }

        return $this;
    }

    public function removeQuizzList(Quizz $quizzList): self
    {
        if ($this->quizzList->removeElement($quizzList)) {
            // set the owning side to null (unless already changed)
            if ($quizzList->getQuizzFounder() === $this) {
                $quizzList->setQuizzFounder(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Play>
     */
    public function getScoreList(): Collection
    {
        return $this->scoreList;
    }

    public function addScoreList(Play $scoreList): self
    {
        if (!$this->scoreList->contains($scoreList)) {
            $this->scoreList->add($scoreList);
            $scoreList->setPlayer($this);
        }

        return $this;
    }

    public function removeScoreList(Play $scoreList): self
    {
        if ($this->scoreList->removeElement($scoreList)) {
            // set the owning side to null (unless already changed)
            if ($scoreList->getPlayer() === $this) {
                $scoreList->setPlayer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Answer>
     */
    public function getAnswerList(): Collection
    {
        return $this->answerList;
    }

    public function addAnswerList(Answer $answerList): self
    {
        if (!$this->answerList->contains($answerList)) {
            $this->answerList->add($answerList);
            $answerList->setPlayer($this);
        }

        return $this;
    }

    public function removeAnswerList(Answer $answerList): self
    {
        if ($this->answerList->removeElement($answerList)) {
            // set the owning side to null (unless already changed)
            if ($answerList->getPlayer() === $this) {
                $answerList->setPlayer(null);
            }
        }

        return $this;
    }
}
