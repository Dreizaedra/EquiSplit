<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Enum\UserStatus;
use App\Repository\UserTravelRepository;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\UniqueConstraint(name: "user_travel_unique", columns: ["user_id", "travel_id"])]
#[ORM\Entity(repositoryClass: UserTravelRepository::class)]
class UserTravel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userTravel')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'userTravel')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Travel $travel = null;

    #[ORM\Column(enumType: UserStatus::class)]
    private ?UserStatus $status = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTravel(): ?Travel
    {
        return $this->travel;
    }

    public function setTravel(?Travel $travel): static
    {
        $this->travel = $travel;

        return $this;
    }

    public function getStatus(): ?UserStatus
    {
        return $this->status;
    }

    public function setStatus(UserStatus $status): static
    {
        $this->status = $status;

        return $this;
    }
}
