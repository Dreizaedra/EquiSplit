<?php

namespace App\Entity;

use App\Enum\LodgingType;
use App\Repository\LodgingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LodgingRepository::class)]
class Lodging
{
    #[ORM\Id]
    #[ORM\OneToOne(inversedBy: 'lodging', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Expense $expense = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 5)]
    private ?string $postalCode = null;

    #[ORM\Column(length: 50)]
    private ?string $town = null;

    #[ORM\Column(enumType: LodgingType::class)]
    private ?LodgingType $type = null;

    #[ORM\Column]
    private ?bool $isMealIncluded = null;

    /**
     * @var Collection<int, OpeningHours>
     */
    #[ORM\OneToMany(targetEntity: OpeningHours::class, mappedBy: 'lodging', orphanRemoval: true)]
    private Collection $openingHours;

    public function __construct()
    {
        $this->openingHours = new ArrayCollection();
    }

    public function getExpense(): ?Expense
    {
        return $this->expense;
    }

    public function setExpense(Expense $expense): static
    {
        $this->expense = $expense;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): static
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function setTown(string $town): static
    {
        $this->town = $town;

        return $this;
    }

    public function getType(): ?LodgingType
    {
        return $this->type;
    }

    public function setType(LodgingType $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function isMealIncluded(): ?bool
    {
        return $this->isMealIncluded;
    }

    public function setIsMealIncluded(bool $isMealIncluded): static
    {
        $this->isMealIncluded = $isMealIncluded;

        return $this;
    }

    /**
     * @return Collection<int, OpeningHours>
     */
    public function getOpeningHours(): Collection
    {
        return $this->openingHours;
    }

    public function addOpeningHour(OpeningHours $openingHour): static
    {
        if (!$this->openingHours->contains($openingHour)) {
            $this->openingHours->add($openingHour);
            $openingHour->setLodging($this);
        }

        return $this;
    }

    public function removeOpeningHour(OpeningHours $openingHour): static
    {
        if ($this->openingHours->removeElement($openingHour)) {
            // set the owning side to null (unless already changed)
            if ($openingHour->getLodging() === $this) {
                $openingHour->setLodging(null);
            }
        }

        return $this;
    }
}
