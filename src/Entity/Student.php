<?php declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Serializable;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\StudentRepository")
 */
class Student implements Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @var User
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity="Course")
     * @ORM\JoinTable(name="students_favorite_courses",
     *     joinColumns={@ORM\JoinColumn(name="student_id", referencedColumnName="id", onDelete="CASCADE")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="course_id", referencedColumnName="id", onDelete="CASCADE")}
     * )
     * @var ArrayCollection|Course[]
     */
    private $favoriteCourses;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->favoriteCourses = new ArrayCollection();
    }

    /**
     * @return Course[]
     */
    public function getFavoriteCourses(): array
    {
        return $this->favoriteCourses->toArray();
    }

    public function addFavoriteCourse(Course $course)
    {
        $this->favoriteCourses->add($course);
    }

    public function getUser(): User
    {
        return $this->user;
    }

    /** @see Serializable::serialize() */
    public function serialize()
    {
        return serialize([
            $this->user,
        ]);
    }

    /** @see Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list ($this->user) = unserialize($serialized, ['allowed_classes' => false]);
    }
}
