<?php

namespace App\Entity;

use App\Repository\PresentationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PresentationRepository::class)
 */
class Presentation
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
    private $titleLeft;

    /**
     * @ORM\Column(type="text")
     */
    private $textRight;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titleRight;

    /**
     * @ORM\Column(type="text")
     */
    private $textLeft;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleLeft(): ?string
    {
        return $this->titleLeft;
    }

    public function setTitleLeft(string $titleLeft): self
    {
        $this->titleLeft = $titleLeft;

        return $this;
    }

    public function getTextRight(): ?string
    {
        return $this->textRight;
    }

    public function setTextRight(string $textRight): self
    {
        $this->textRight = $textRight;

        return $this;
    }

    public function getTitleRight(): ?string
    {
        return $this->titleRight;
    }

    public function setTitleRight(string $titleRight): self
    {
        $this->titleRight = $titleRight;

        return $this;
    }

    public function getTextLeft(): ?string
    {
        return $this->textLeft;
    }

    public function setTextLeft(string $textLeft): self
    {
        $this->textLeft = $textLeft;

        return $this;
    }
}
