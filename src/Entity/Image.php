<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
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
    private $urlpath;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $title;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrlpath(): ?string
    {
        return $this->urlpath;
    }

    public function setUrlpath(string $urlpath): self
    {
        $this->urlpath = $urlpath;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
}
