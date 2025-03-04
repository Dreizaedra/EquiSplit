<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ApiResource]
#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, unique: true)]
    private ?string $pseudo = null;

    #[ORM\Column(length: 100, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 60)]
    private ?string $password = null;

    /**
     * @var Collection<int, UserTravel>
     */
    #[ORM\OneToMany(targetEntity: UserTravel::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $userTravel;

    /**
     * @var Collection<int, UserExpense>
     */
    #[ORM\OneToMany(targetEntity: UserExpense::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $userExpenses;

    public function __construct()
    {
        $this->userTravel = new ArrayCollection();
        $this->userExpenses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): static
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles ?? [];
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function eraseCredentials(): void {}

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

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
            $userTravel->setUser($this);
        }

        return $this;
    }

    public function removeUserTravel(UserTravel $userTravel): static
    {
        if ($this->userTravel->removeElement($userTravel)) {
            // set the owning side to null (unless already changed)
            if ($userTravel->getUser() === $this) {
                $userTravel->setUser(null);
            }
        }

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
            $userExpense->setUser($this);
        }

        return $this;
    }

    public function removeUserExpense(UserExpense $userExpense): static
    {
        if ($this->userExpenses->removeElement($userExpense)) {
            // set the owning side to null (unless already changed)
            if ($userExpense->getUser() === $this) {
                $userExpense->setUser(null);
            }
        }

        return $this;
    }
}
