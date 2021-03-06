<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints\DemiJournee;

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
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Vous n'avez pas renseigné le prénom")
     */
    private $prenom;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Vous n'avez pas renseigné le type de billet")
     */
    private $typeBillet;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Vous n'avez pas votre pays")
     */
    private $pays;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Vous n'avez pas renseigné votre date de naissance")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="boolean")
     */
    private $tarifReduit;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commande", inversedBy="billets")
     * @ORM\JoinColumn(nullable=true)
     */
    private $commande;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prix;


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

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(?int $prix): self
    {

        $this->prix = $prix;

        return $this;
    }
}
