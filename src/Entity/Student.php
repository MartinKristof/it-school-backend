<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StudentRepository")
 */
class Student extends User
{
    /**
     * @ORM\ManyToMany(targetEntity="Course")
     * @ORM\JoinTable(name="students_favorite_courses",
     *     joinColumns={@ORM\JoinColumn(name="student_id", referencedColumnName="id", onDelete="CASCADE")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="course_id", referencedColumnName="id", onDelete="CASCADE")}
     * )
     * @var ArrayCollection|Course[]
     */
    private $favoriteCourses;

    public function __construct(string $name, string $username)
    {
        parent::__construct($name, $username);

        $this->favoriteCourses = new ArrayCollection();
    }

    /**
     * @return Course[]
     */
    public function getFavoriteCourses(): array
    {
        return $this->favoriteCourses->toArray();
    }
}
