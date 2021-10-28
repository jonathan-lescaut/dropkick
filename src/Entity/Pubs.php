<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Validator\Constraints\Collection;


// ancienne annotation  erreur =>
// =============================================================================================
// The "App\Entity\Pubs" entity has a repositoryClass set to "App\Entity\PubsRepository",
//  but this is not a valid class. Check your class naming. If this is meant to be a service id, 
//  make sure this service exists and is tagged with "doctrine.repository_service".
// @ORM\Entity(repositoryClass=PubsRepository::class)


/**
 * @ORM\Entity(repositoryClass="App\Repository\PubsRepository")
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
     * @ORM\Column(type="string", length=255)
     */
    private $cityPub;

    /**
     * @ORM\OneToMany(targetEntity=Products::class, mappedBy="pub")
     */
    private $products;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cardPdf;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $addressPub;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $phonePub;

    /**
     * @ORM\Column(type="text")
     */
    private $iframePub;

    /**
     * @ORM\Column(type="integer")
     */
    private $cpPub;

    /**
     * @ORM\Column(type="text")
     */
    private $schedulePub;


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

    public function getCityPub(): ?string
    {
        return $this->cityPub;
    }

    public function setCityPub(string $cityPub): self
    {
        $this->cityPub = $cityPub;

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
            $product->setPub($this);
        }

        return $this;
    }

    public function removeProduct(Products $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getPub() === $this) {
                $product->setPub(null);
            }
        }

        return $this;
    }

    public function getCardPdf(): ?string
    {
        return $this->cardPdf;
    }

    public function setCardPdf(string $cardPdf): self
    {
        $this->cardPdf = $cardPdf;

        return $this;
    }

    public function getAddressPub(): ?string
    {
        return $this->addressPub;
    }

    public function setAddressPub(string $addressPub): self
    {
        $this->addressPub = $addressPub;

        return $this;
    }

    public function getPhonePub(): ?string
    {
        return $this->phonePub;
    }

    public function setPhonePub(string $phonePub): self
    {
        $this->phonePub = $phonePub;

        return $this;
    }

    public function getIframePub(): ?string
    {
        return $this->iframePub;
    }

    public function setIframePub(string $iframePub): self
    {
        $this->iframePub = $iframePub;

        return $this;
    }

    public function getCpPub(): ?int
    {
        return $this->cpPub;
    }

    public function setCpPub(int $cpPub): self
    {
        $this->cpPub = $cpPub;

        return $this;
    }

    public function getSchedulePub(): ?string
    {
        return $this->schedulePub;
    }

    public function setSchedulePub(string $schedulePub): self
    {
        $this->schedulePub = $schedulePub;
        return $this;
    }

}
