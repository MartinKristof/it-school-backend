<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LectorRepository")
 */
class Lector
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array")
     * @ORM\ManyToMany(targetEntity="Tag")
     */
    private $specialization = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpecialization(): ?array
    {
        return $this->specialization;
    }

    public function setSpecialization(array $specialization): self
    {
        $this->specialization = $specialization;

        return $this;
    }
}
