<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StudentRepository")
 */
class Student
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array")
     * @ORM\ManyToMany(targetEntity="Course")
     */
    private $favorites = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFavorites(): ?array
    {
        return $this->favorites;
    }

    public function setFavorites(array $favorites): self
    {
        $this->favorites = $favorites;

        return $this;
    }
}
