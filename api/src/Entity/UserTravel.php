<?php

namespace App\Entity;

use App\Enum\UserStatus;
use App\Repository\UserTravelRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserTravelRepository::class)]
class UserTravel
{
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'userTravel')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'userTravel')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Travel $travel = null;

    #[ORM\Column(enumType: UserStatus::class)]
    private ?UserStatus $status = null;

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
