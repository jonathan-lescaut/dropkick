<?php

namespace App\Entity;

use App\Repository\PubsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PubsRepository::class)
 */
class Pubs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $namePub;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imgPub;

    /**
     * @ORM\Column(type="text")
     */
    private $contentPub;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="pubs")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Events::class, mappedBy="pubs")
     */
    private $events;

    /**
     * @ORM\ManyToMany(targetEntity=Products::class, inversedBy="pubs")
     */
    private $products;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamePub(): ?string
    {
        return $this->namePub;
    }

    public function setNamePub(string $namePub): self
    {
        $this->namePub = $namePub;

        return $this;
    }

    public function getImgPub(): ?string
    {
        return $this->imgPub;
    }

    public function setImgPub(string $imgPub): self
    {
        $this->imgPub = $imgPub;

        return $this;
    }

    public function getContentPub(): ?string
    {
        return $this->contentPub;
    }

    public function setContentPub(string $contentPub): self
    {
        $this->contentPub = $contentPub;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setPubs($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getPubs() === $this) {
                $user->setPubs(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Events[]
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Events $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->setPubs($this);
        }

        return $this;
    }

    public function removeEvent(Events $event): self
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getPubs() === $this) {
                $event->setPubs(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Products[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Products $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
        }

        return $this;
    }

    public function removeProduct(Products $product): self
    {
        $this->products->removeElement($product);

        return $this;
    }
}
