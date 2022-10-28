<?php

namespace App\Entity;

use App\Repository\BreweryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BreweryRepository::class)
 */
class Brewery
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
     * @ORM\OneToMany(targetEntity=Cap::class, mappedBy="brewery")
     */
    private $caps;

    public function __construct()
    {
        $this->caps = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Cap>
     */
    public function getCaps(): Collection
    {
        return $this->caps;
    }

    public function addCap(Cap $cap): self
    {
        if (!$this->caps->contains($cap)) {
            $this->caps[] = $cap;
            $cap->setBrewery($this);
        }

        return $this;
    }

    public function removeCap(Cap $cap): self
    {
        if ($this->caps->removeElement($cap)) {
            // set the owning side to null (unless already changed)
            if ($cap->getBrewery() === $this) {
                $cap->setBrewery(null);
            }
        }

        return $this;
    }
}
