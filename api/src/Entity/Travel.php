<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use App\Controller\TravelApiController;
use App\Repository\TravelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Post(),
        new Patch(),
        new Delete(),
        new Get(
            uriTemplate: '/travel/{id}/balance',
            controller: TravelApiController::class,
            name: 'app_travel_balance',
        ),
    ],
)]
#[ORM\Entity(repositoryClass: TravelRepository::class)]
class Travel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $endDate = null;

    /**
     * @var Collection<int, Expense>
     */
    #[ORM\OneToMany(targetEntity: Expense::class, mappedBy: 'travel', orphanRemoval: true)]
    private Collection $expenses;

    /**
     * @var Collection<int, UserTravel>
     */
    #[ORM\OneToMany(targetEntity: UserTravel::class, mappedBy: 'travel', orphanRemoval: true)]
    private Collection $userTravel;

    /**
     * @var Collection<int, Media>
     */
    #[ORM\OneToMany(targetEntity: Media::class, mappedBy: 'travel', orphanRemoval: true)]
    private Collection $media;

    public function __construct()
    {
        $this->expenses = new ArrayCollection();
        $this->userTravel = new ArrayCollection();
        $this->media = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTimeInterface $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return Collection<int, Expense>
     */
    public function getExpenses(): Collection
    {
        return $this->expenses;
    }

    public function addExpense(Expense $expense): static
    {
        if (!$this->expenses->contains($expense)) {
            $this->expenses->add($expense);
            $expense->setTravel($this);
        }

        return $this;
    }

    public function removeExpense(Expense $expense): static
    {
        if ($this->expenses->removeElement($expense)) {
            // set the owning side to null (unless already changed)
            if ($expense->getTravel() === $this) {
                $expense->setTravel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserTravel>
     */
    public function getUserTravel(): Collection
    {
        return $this->userTravel;
    }

    public function addUserTravel(UserTravel $userTravel): static
    {
        if (!$this->userTravel->contains($userTravel)) {
            $this->userTravel->add($userTravel);
            $userTravel->setTravel($this);
        }

        return $this;
    }

    public function removeUserTravel(UserTravel $userTravel): static
    {
        if ($this->userTravel->removeElement($userTravel)) {
            // set the owning side to null (unless already changed)
            if ($userTravel->getTravel() === $this) {
                $userTravel->setTravel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Media>
     */
    public function getMedia(): Collection
    {
        return $this->media;
    }

    public function addMedium(Media $medium): static
    {
        if (!$this->media->contains($medium)) {
            $this->media->add($medium);
            $medium->setTravel($this);
        }

        return $this;
    }

    public function removeMedium(Media $medium): static
    {
        if ($this->media->removeElement($medium)) {
            // set the owning side to null (unless already changed)
            if ($medium->getTravel() === $this) {
                $medium->setTravel(null);
            }
        }

        return $this;
    }
}
