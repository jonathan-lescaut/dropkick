<?php

namespace App\Entity;

use App\Repository\MenusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MenusRepository::class)
 */
class Menus
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
    private $nameMenu;

    /**
     * @ORM\ManyToMany(targetEntity=Products::class, mappedBy="menus")
     */
    private $products;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $priceMenu;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imgMenu;

    /**
     * @ORM\ManyToOne(targetEntity=Pubs::class, inversedBy="menus")
     */
    private $pubs;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameMenu(): ?string
    {
        return $this->nameMenu;
    }

    public function setNameMenu(string $nameMenu): self
    {
        $this->nameMenu = $nameMenu;

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
            $product->addMenu($this);
        }

        return $this;
    }

    public function removeProduct(Products $product): self
    {
        if ($this->products->removeElement($product)) {
            $product->removeMenu($this);
        }

        return $this;
    }

    public function getPriceMenu(): ?string
    {
        return $this->priceMenu;
    }

    public function setPriceMenu(string $priceMenu): self
    {
        $this->priceMenu = $priceMenu;

        return $this;
    }

    public function getImgMenu(): ?string
    {
        return $this->imgMenu;
    }

    public function setImgMenu(string $imgMenu): self
    {
        $this->imgMenu = $imgMenu;

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
}
