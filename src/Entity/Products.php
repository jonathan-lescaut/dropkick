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
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="products")
     */
    private $categories;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imgProduct;

    /**
     * @ORM\ManyToOne(targetEntity=Pubs::class, inversedBy="products")
     */
    private $pub;

    /**
     * @ORM\Column(type="boolean")
     */
    private $productStar;


    public function __construct()
    {
        $this->orders = new ArrayCollection();
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

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories): self
    {
        $this->categories = $categories;

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

    public function getPub(): ?Pubs
    {
        return $this->pub;
    }

    public function setPub(?Pubs $pub): self
    {
        $this->pub = $pub;

        return $this;
    }

    public function getProductStar(): ?bool
    {
        return $this->productStar;
    }

    public function setProductStar(bool $productStar): self
    {
        $this->productStar = $productStar;

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
            $order->setProduct($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getProduct() === $this) {
                $order->setProduct(null);
            }
        }

        return $this;
    }
}
