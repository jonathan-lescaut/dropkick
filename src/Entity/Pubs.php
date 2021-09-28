<?php

namespace App\Entity;

use App\Repository\PubsRepository;
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
}
