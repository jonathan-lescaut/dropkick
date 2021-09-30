<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductsRepository::class)
 */
class Products
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
    private $nameProduct;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $priceProduct;

    /**
     * @ORM\Column(type="text")
     */
    private $contentProduct;

    /**
     * @ORM\ManyToMany(targetEntity=Pubs::class, inversedBy="products")
     */
    private $pubs;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="products")
     */
    private $categories;

    /**
     * @ORM\ManyToMany(targetEntity=Menus::class, inversedBy="products")
     */
    private $menus;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imgProduct;

    public function __construct()
    {
        $this->pubs = new ArrayCollection();
        $this->menus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameProduct(): ?string
    {
        return $this->nameProduct;
    }

    public function setNameProduct(string $nameProduct): self
    {
        $this->nameProduct = $nameProduct;

        return $this;
    }

    public function getPriceProduct(): ?string
    {
        return $this->priceProduct;
    }

    public function setPriceProduct(string $priceProduct): self
    {
        $this->priceProduct = $priceProduct;

        return $this;
    }

    public function getContentProduct(): ?string
    {
        return $this->contentProduct;
    }

    public function setContentProduct(string $contentProduct): self
    {
        $this->contentProduct = $contentProduct;

        return $this;
    }

    /**
     * @return Collection|Pubs[]
     */
    public function getPubs(): Collection
    {
        return $this->pubs;
    }

    public function addPub(Pubs $pub): self
    {
        if (!$this->pubs->contains($pub)) {
            $this->pubs[] = $pub;
            $pub->addProduct($this);
        }

        return $this;
    }

    public function removePub(Pubs $pub): self
    {
        if ($this->pubs->removeElement($pub)) {
            $pub->removeProduct($this);
        }

        return $this;
    }

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return Collection|Menus[]
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(Menus $menu): self
    {
        if (!$this->menus->contains($menu)) {
            $this->menus[] = $menu;
        }

        return $this;
    }

    public function removeMenu(Menus $menu): self
    {
        $this->menus->removeElement($menu);

        return $this;
    }

    public function getImgProduct(): ?string
    {
        return $this->imgProduct;
    }

    public function setImgProduct(string $imgProduct): self
    {
        $this->imgProduct = $imgProduct;

        return $this;
    }
}
