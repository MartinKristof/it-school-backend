<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LectorRepository")
 */
class Lector extends User
{
    /**
     * @ORM\ManyToMany(targetEntity="Tag")
     * @ORM\JoinTable(name="lectors_specializations",
     *     joinColumns={@ORM\JoinColumn(name="lector_id", referencedColumnName="id", onDelete="CASCADE")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id", onDelete="CASCADE")}
     * )
     * @var ArrayCollection|Tag[]
     */
    private $specializations;

    public function __construct(string $name, string $username)
    {
        parent::__construct($name, $username);

        $this->specializations = new ArrayCollection();
    }

    /**
     * @return Tag[]
     */
    public function getSpecializations(): array
    {
        return $this->specializations->toArray();
    }
}
