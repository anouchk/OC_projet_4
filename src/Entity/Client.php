<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client
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
    private $mail;

    /**
     * @ORM\Column(type="integer")
     */
    private $CbNumber;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Commande", mappedBy="client", cascade={"persist", "remove"})
     */
    private $commande;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getCbNumber(): ?int
    {
        return $this->CbNumber;
    }

    public function setCbNumber(int $CbNumber): self
    {
        $this->CbNumber = $CbNumber;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(Commande $commande): self
    {
        $this->commande = $commande;

        // set the owning side of the relation if necessary
        if ($this !== $commande->getClient()) {
            $commande->setClient($this);
        }

        return $this;
    }
}
