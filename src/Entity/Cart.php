<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CartRepository::class)
 */
class Cart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $contentCart;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="carts")
     */
    private $userCart;

    /**
     * @ORM\Column(type="float")
     */
    private $totalCart;

    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="cartOrder")
     */
    private $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContentCart(): ?string
    {
        return $this->contentCart;
    }

    public function setContentCart(string $contentCart): self
    {
        $this->contentCart = $contentCart;

        return $this;
    }

    public function getUserCart(): ?User
    {
        return $this->userCart;
    }

    public function setUserCart(?User $userCart): self
    {
        $this->userCart = $userCart;

        return $this;
    }

    public function getTotalCart(): ?float
    {
        return $this->totalCart;
    }

    public function setTotalCart(float $totalCart): self
    {
        $this->totalCart = $totalCart;

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
            $order->setCartOrder($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getCartOrder() === $this) {
                $order->setCartOrder(null);
            }
        }

        return $this;
    }
}
