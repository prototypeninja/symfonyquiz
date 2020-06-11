<?php

namespace App\Entity;

use App\Repository\QuestiontabRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuestiontabRepository::class)
 */
class Questiontab
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $questions;

    /**
     * @ORM\OneToMany(targetEntity=Reponsetab::class, mappedBy="question", orphanRemoval=true)
     */
    private $reponsetabs;

    public function __construct()
    {
        $this->reponsetabs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestions(): ?string
    {
        return $this->questions;
    }

    public function setQuestions(string $questions): self
    {
        $this->questions = $questions;

        return $this;
    }

    /**
     * @return Collection|Reponsetab[]
     */
    public function getReponsetabs(): Collection
    {
        return $this->reponsetabs;
    }

    public function addReponsetab(Reponsetab $reponsetab): self
    {
        if (!$this->reponsetabs->contains($reponsetab)) {
            $this->reponsetabs[] = $reponsetab;
            $reponsetab->setQuestion($this);
        }

        return $this;
    }

    public function removeReponsetab(Reponsetab $reponsetab): self
    {
        if ($this->reponsetabs->contains($reponsetab)) {
            $this->reponsetabs->removeElement($reponsetab);
            // set the owning side to null (unless already changed)
            if ($reponsetab->getQuestion() === $this) {
                $reponsetab->setQuestion(null);
            }
        }

        return $this;
    }
}
