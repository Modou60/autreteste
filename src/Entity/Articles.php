<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ArticlesRepository::class)
 */
class Articles
{
    /**
     * @Assert/NotBlank
     */
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     * min = 5,
     * max = 40,
     * minMessage = "Le titre doit avoir au minimum {{ limit }} characters",
     * maxMessage = "le titre ne doit pas dépasser {{ limit }} characters")
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(
     * min = 5,
     * max = 100,
     * minMessage = "Le contenu doit avoir minimum {{ limit }} caractères",
     * maxMessage = "Le contenu doit avoir au maximum {{ limit }} characters")
     */
    private $contenu;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="text")
     * @ORM\Column(type="text")
     * @Assert\Length(
     * min = 6,
     * max = 100,
     * minMessage = "Le résumé doit avoir minimum {{ limit }} characters",
     * maxMessage = "Le résumé doit avoir au maximum {{ limit }} characters")
     */
    private $resume;
	
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

}
