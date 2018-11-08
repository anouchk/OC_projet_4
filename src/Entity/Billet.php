<?php

namespace App\Entity;

use App\Validator\Constraints\Minimum;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BilletRepository")
 */
class Billet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Vous n'avez pas renseigné le nom")
     * @Assert\Length(min="2", minMessage="Il faut 2 caractères minimum")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Vous n'avez pas renseigné le prénom")
     * @Minimum()
     */
    private $prenom;

    /**
     * @ORM\Column(type="integer")
     */
    private $typeBillet;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pays;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="boolean")
     */
    private $tarifReduit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTypeBillet(): ?int
    {
        return $this->typeBillet;
    }

    public function setTypeBillet(int $typeBillet): self
    {
        $this->typeBillet = $typeBillet;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getTarifReduit(): ?bool
    {
        return $this->tarifReduit;
    }

    public function setTarifReduit(bool $tarifReduit): self
    {
        $this->tarifReduit = $tarifReduit;

        return $this;
    }
}
