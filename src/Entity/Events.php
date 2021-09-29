<?php

namespace App\Entity;

use App\Repository\EventsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EventsRepository::class)
 */
class Events
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
    private $nameEvent;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imgEvent;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateEvent;

    /**
     * @ORM\Column(type="text")
     */
    private $contentEvent;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $placeEvent;

    /**
     * @ORM\ManyToOne(targetEntity=Pubs::class, inversedBy="events")
     */
    private $pubs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameEvent(): ?string
    {
        return $this->nameEvent;
    }

    public function setNameEvent(string $nameEvent): self
    {
        $this->nameEvent = $nameEvent;

        return $this;
    }

    public function getImgEvent(): ?string
    {
        return $this->imgEvent;
    }

    public function setImgEvent(string $imgEvent): self
    {
        $this->imgEvent = $imgEvent;

        return $this;
    }

    public function getDateEvent(): ?\DateTimeInterface
    {
        return $this->dateEvent;
    }

    public function setDateEvent(\DateTimeInterface $dateEvent): self
    {
        $this->dateEvent = $dateEvent;

        return $this;
    }

    public function getContentEvent(): ?string
    {
        return $this->contentEvent;
    }

    public function setContentEvent(string $contentEvent): self
    {
        $this->contentEvent = $contentEvent;

        return $this;
    }

    public function getPlaceEvent(): ?string
    {
        return $this->placeEvent;
    }

    public function setPlaceEvent(string $placeEvent): self
    {
        $this->placeEvent = $placeEvent;

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
