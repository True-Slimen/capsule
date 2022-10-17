<?php

namespace App\Entity;

use App\Repository\CapsControllerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CapsControllerRepository::class)
 */
class CapsController
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
    private $Cap;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCap(): ?string
    {
        return $this->Cap;
    }

    public function setCap(string $Cap): self
    {
        $this->Cap = $Cap;

        return $this;
    }
}
