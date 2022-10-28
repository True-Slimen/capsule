<?php

namespace App\Entity;

use App\Repository\CapRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
use DateTimeInterface;

/**
 * @ORM\Entity(repositoryClass=CapRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Cap
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
    private $name;
    
    /**
     * @ORM\Column(type="string", length= 1454, nullable=true)
     */
    private $picture_path;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $num_lambert;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cotation;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\ManyToOne(targetEntity=Brewery::class, inversedBy="caps")
     */
    private $brewery;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPicturePath(): ?string
    {
        return $this->picture_path;
    }

    public function setPicturePath(string $picture_path): self
    {
        $this->picture_path = $picture_path;

        return $this;
    }

    public function getNumLambert(): ?string
    {
        return $this->num_lambert;
    }

    public function setNumLambert(?string $num_lambert): self
    {
        $this->num_lambert = $num_lambert;

        return $this;
    }

    public function getCotation(): ?int
    {
        return $this->cotation;
    }

    public function setCotation(?int $cotation): self
    {
        $this->cotation = $cotation;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getBrewery(): ?brewery
    {
        return $this->brewery;
    }

    public function setBrewery(?brewery $brewery): self
    {
        $this->brewery = $brewery;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtAutomatically(): void
    {
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTimeImmutable());
        }
    }
}
