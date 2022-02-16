<?php

namespace App\Entity;

use App\Entity\Pubs;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    public const ROLE_USER = 'ROLE_USER'; 
    public const ROLE_WORKER = 'ROLE_WORKER';
    public const ROLE_MASTER = 'ROLE_MASTER';
    public const ROLE_ADMIN = 'ROLE_ADMIN';
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Email(message = "Votre email '{{ value }}' n'est pas valide")
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastNameUser;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstNameUser;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $addressUser;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cityUser;

    /**
     * @ORM\Column(type="integer")
     */
    private $cpUser;

    /**
     * @ORM\ManyToOne(targetEntity=Pubs::class, inversedBy="users")
     */
    private $pubs;

    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="user")
     */
    private $orders;

    /**
     * @ORM\OneToMany(targetEntity=Cart::class, mappedBy="userCart")
     */
    private $carts;

    public function __construct(){ 
        $this->roles = [self::ROLE_USER];
        $this->orders = new ArrayCollection();
        $this->carts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getLastNameUser(): ?string
    {
        return $this->lastNameUser;
    }

    public function setLastNameUser(string $lastNameUser): self
    {
        $this->lastNameUser = $lastNameUser;

        return $this;
    }

    public function getFirstNameUser(): ?string
    {
        return $this->firstNameUser;
    }

    public function setFirstNameUser(string $firstNameUser): self
    {
        $this->firstNameUser = $firstNameUser;

        return $this;
    }

    public function getAddressUser(): ?string
    {
        return $this->addressUser;
    }

    public function setAddressUser(string $addressUser): self
    {
        $this->addressUser = $addressUser;

        return $this;
    }

    public function getCityUser(): ?string
    {
        return $this->cityUser;
    }

    public function setCityUser(string $cityUser): self
    {
        $this->cityUser = $cityUser;

        return $this;
    }

    public function getCpUser(): ?int
    {
        return $this->cpUser;
    }

    public function setCpUser(int $cpUser): self
    {
        $this->cpUser = $cpUser;

        return $this;
    }

    public function getPubs(): ?Pubs
    {
        return $this->pubs;
    }

    public function setPubs(?Pubs $pubs): self
    {
        $this->pubs = $pubs;

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setUser($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getUser() === $this) {
                $order->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Cart[]
     */
    public function getCarts(): Collection
    {
        return $this->carts;
    }

    public function addCart(Cart $cart): self
    {
        if (!$this->carts->contains($cart)) {
            $this->carts[] = $cart;
            $cart->setUserCart($this);
        }

        return $this;
    }

    public function removeCart(Cart $cart): self
    {
        if ($this->carts->removeElement($cart)) {
            // set the owning side to null (unless already changed)
            if ($cart->getUserCart() === $this) {
                $cart->setUserCart(null);
            }
        }

        return $this;
    }

}
