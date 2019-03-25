<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="integer")
     * @ORM\OneToOne(targetEntity="Address")
     */
    private $address;

    /**
     * @ORM\Column(type="array")
     * @ORM\ManyToMany(targetEntity="Course")
     */
    private $courses = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @ORM\OneToOne(targetEntity="Student")
     */
    private $studentID;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @ORM\OneToOne(targetEntity="Lector")
     */
    private $lectorID;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @ORM\OneToOne(targetEntity="Image")
     */
    private $image;

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

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getAddress(): ?int
    {
        return $this->address;
    }

    public function setAddress(int $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCourses(): ?array
    {
        return $this->courses;
    }

    public function setCourses(array $courses): self
    {
        $this->courses = $courses;

        return $this;
    }

    public function getStudentID(): ?int
    {
        return $this->studentID;
    }

    public function setStudentID(int $studentID): self
    {
        $this->studentID = $studentID;

        return $this;
    }

    public function getLectorID(): ?int
    {
        return $this->lectorID;
    }

    public function setLectorID(int $lectorID): self
    {
        $this->lectorID = $lectorID;

        return $this;
    }

    public function getImage(): ?int
    {
        return $this->image;
    }

    public function setImage(int $image): self
    {
        $this->image = $image;

        return $this;
    }
}
