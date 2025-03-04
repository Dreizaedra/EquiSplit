<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ExpenseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity(repositoryClass: ExpenseRepository::class)]
class Expense
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'expenses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Travel $travel = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?int $price = null;

    /**
     * @var Collection<int, UserExpense>
     */
    #[ORM\OneToMany(targetEntity: UserExpense::class, mappedBy: 'expense', orphanRemoval: true)]
    private Collection $userExpenses;

    /**
     * @var Collection<int, Media>
     */
    #[ORM\OneToMany(targetEntity: Media::class, mappedBy: 'expense')]
    private Collection $media;

    #[ORM\OneToOne(mappedBy: 'expense', cascade: ['persist', 'remove'])]
    private ?Lodging $lodging = null;

    /**
     * @var Collection<int, Contact>
     */
    #[ORM\OneToMany(targetEntity: Contact::class, mappedBy: 'expense', orphanRemoval: true)]
    private Collection $contacts;

    /**
     * @var Collection<int, BusinessLinks>
     */
    #[ORM\OneToMany(targetEntity: BusinessLinks::class, mappedBy: 'expense', orphanRemoval: true)]
    private Collection $businessLinks;

    public function __construct()
    {
        $this->userExpenses = new ArrayCollection();
        $this->media = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        $this->businessLinks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): static
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, UserExpense>
     */
    public function getUserExpenses(): Collection
    {
        return $this->userExpenses;
    }

    public function addUserExpense(UserExpense $userExpense): static
    {
        if (!$this->userExpenses->contains($userExpense)) {
            $this->userExpenses->add($userExpense);
            $userExpense->setExpense($this);
        }

        return $this;
    }

    public function removeUserExpense(UserExpense $userExpense): static
    {
        if ($this->userExpenses->removeElement($userExpense)) {
            // set the owning side to null (unless already changed)
            if ($userExpense->getExpense() === $this) {
                $userExpense->setExpense(null);
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
            $medium->setExpense($this);
        }

        return $this;
    }

    public function removeMedium(Media $medium): static
    {
        if ($this->media->removeElement($medium)) {
            // set the owning side to null (unless already changed)
            if ($medium->getExpense() === $this) {
                $medium->setExpense(null);
            }
        }

        return $this;
    }

    public function getLodging(): ?Lodging
    {
        return $this->lodging;
    }

    public function setLodging(Lodging $lodging): static
    {
        // set the owning side of the relation if necessary
        if ($lodging->getExpense() !== $this) {
            $lodging->setExpense($this);
        }

        $this->lodging = $lodging;

        return $this;
    }

    /**
     * @return Collection<int, Contact>
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): static
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts->add($contact);
            $contact->setExpense($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): static
    {
        if ($this->contacts->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getExpense() === $this) {
                $contact->setExpense(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BusinessLinks>
     */
    public function getBusinessLinks(): Collection
    {
        return $this->businessLinks;
    }

    public function addBusinessLink(BusinessLinks $businessLink): static
    {
        if (!$this->businessLinks->contains($businessLink)) {
            $this->businessLinks->add($businessLink);
            $businessLink->setExpense($this);
        }

        return $this;
    }

    public function removeBusinessLink(BusinessLinks $businessLink): static
    {
        if ($this->businessLinks->removeElement($businessLink)) {
            // set the owning side to null (unless already changed)
            if ($businessLink->getExpense() === $this) {
                $businessLink->setExpense(null);
            }
        }

        return $this;
    }
}
