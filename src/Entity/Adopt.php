<?php

namespace App\Entity;

use App\Repository\AdoptRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdoptRepository::class)]
class Adopt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $money = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'adopts', cascade:['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'adopts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?OrangOutan $orangoutan = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMoney(): ?float
    {
        return $this->money;
    }

    public function setMoney(float $money): static
    {
        $this->money = $money;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getOrangoutan(): ?OrangOutan
    {
        return $this->orangoutan;
    }

    public function setOrangoutan(?OrangOutan $orangoutan): static
    {
        $this->orangoutan = $orangoutan;

        return $this;
    }
}
