<?php

namespace App\Entity;


use App\Entity\Traits\StripeTrait;
use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;


/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 * @ORM\Table(name="`order`")
 */
class Order
{

    const DEVISE = 'eur';

    use StripeTrait;
    use TimestampableEntity;


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $referenceOrder;

    /**
     * @ORM\Column(type="float")
     */
    private $priceOrder;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="orders")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Cart::class, inversedBy="orders")
     */
    private $cartOrder;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReferenceOrder(): ?string
    {
        return $this->referenceOrder;
    }

    public function setReferenceOrder(string $referenceOrder): self
    {
        $this->referenceOrder = $referenceOrder;

        return $this;
    }

    public function getPriceOrder(): ?float
    {
        return $this->priceOrder;
    }

    public function setPriceOrder(float $priceOrder): self
    {
        $this->priceOrder = $priceOrder;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCartOrder(): ?Cart
    {
        return $this->cartOrder;
    }

    public function setCartOrder(?Cart $cartOrder): self
    {
        $this->cartOrder = $cartOrder;

        return $this;
    }
}
