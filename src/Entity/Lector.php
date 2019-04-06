<?php declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Serializable;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\LectorRepository")
 */
class Lector implements Serializable
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
     * @ORM\JoinTable(name="lectors_teached_courses",
     *     joinColumns={@ORM\JoinColumn(name="lector_id", referencedColumnName="id", onDelete="CASCADE")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="course_id", referencedColumnName="id", onDelete="CASCADE")}
     * )
     * @var ArrayCollection|Course[]
     */
    private $teachedCourses;

    /**
     * @ORM\ManyToMany(targetEntity="Tag")
     * @ORM\JoinTable(name="lectors_specializations",
     *     joinColumns={@ORM\JoinColumn(name="lector_id", referencedColumnName="id", onDelete="CASCADE")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id", onDelete="CASCADE")}
     * )
     * @var ArrayCollection|Tag[]
     */
    private $specializations;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->specializations = new ArrayCollection();
        $this->teachedCourses = new ArrayCollection();
    }

    /**
     * @return Tag[]
     */
    public function getSpecializations(): array
    {
        return $this->specializations->toArray();
    }

    public function addSpecialization(Tag $specialization)
    {
        $this->specializations->add($specialization);
    }

    public function getImage(): Image
    {
        return $this->user->getImage();
    }

    /**
     * @return Course[]
     */
    public function getTeachedCourses(): array
    {
        return $this->teachedCourses->toArray();
    }

    public function addTeachedCourse(Course $course)
    {
        $this->teachedCourses->add($course);
    }

    public function getId(): int
    {
        return $this->id;
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
