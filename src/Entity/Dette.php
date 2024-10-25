<?php

namespace App\Entity;

use App\Repository\DetteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetteRepository::class)]
class Dette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private ?float $montant = null;

    #[ORM\Column(type: 'datetime', name: 'date')] // Utilisation du nom de colonne exact
    private ?\DateTimeInterface $dateDette = null;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'dettes')]
    #[ORM\JoinColumn(name: 'client_id', referencedColumnName: 'id', nullable: false)] // Assurez-vous que cela correspond à votre configuration
    private ?Client $client = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDateDette(): ?\DateTimeInterface
    {
        return $this->dateDette;
    }

    public function setDateDette(\DateTimeInterface $dateDette): self
    {
        $this->dateDette = $dateDette;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}
