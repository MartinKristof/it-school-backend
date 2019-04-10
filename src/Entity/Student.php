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

    /**
     * @ORM\ManyToMany(targetEntity="Course")
     * @ORM\JoinTable(name="students_attended_courses",
     *     joinColumns={@ORM\JoinColumn(name="student_id", referencedColumnName="id", onDelete="CASCADE")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="course_id", referencedColumnName="id", onDelete="CASCADE")}
     * )
     * @var ArrayCollection|Course[]
     */
    private $attendedCourses;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->favoriteCourses = new ArrayCollection();
        $this->attendedCourses = new ArrayCollection();
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

    /**
     * @param Course[]|ArrayCollection $favoriteCourses
     */
    public function setFavoriteCourses($courses)
    {
        $this->favoriteCourses = $courses;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getImage(): ?Image
    {
        return $this->getUser()->getImage();
    }

    /**
     * @return Course[]
     */
    public function getAttendedCourses(): array
    {
        return $this->attendedCourses->toArray();
    }

    /**
     * @param Course[]|ArrayCollection $attendedCourses
     */
    public function setAttendedCourses($courses)
    {
        $this->attendedCourses = $courses;
    }

    public function addAttendedCourse(Course $course)
    {
        $this->attendedCourses->add($course);
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
