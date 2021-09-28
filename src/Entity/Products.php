<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
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
}
