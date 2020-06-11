<?php

namespace App\Entity;

use App\Repository\ReponsetabRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReponsetabRepository::class)
 */
class Reponsetab
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=questiontab::class, inversedBy="reponsetabs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $question;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reponses;

    /**
     * @ORM\Column(type="boolean")
     */
    private $statu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?questiontab
    {
        return $this->question;
    }

    public function setQuestion(?questiontab $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getReponses(): ?string
    {
        return $this->reponses;
    }

    public function setReponses(string $reponses): self
    {
        $this->reponses = $reponses;

        return $this;
    }

    public function getStatu(): ?bool
    {
        return $this->statu;
    }

    public function setStatu(bool $statu): self
    {
        $this->statu = $statu;

        return $this;
    }
}
