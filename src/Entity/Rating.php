<?php declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Assert\Assertion;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"post"}},
 *     denormalizationContext={"groups"={"get"}},
 *     collectionOperations={
 *         "get",
 *         "post"
 *     },
 *     itemOperations={
 *         "get",
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\RatingRepository")
 */
class Rating
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @Groups({"get", "post"})
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Groups({"get", "post"})
     * @var string
     */
    private $text;

    /**
     * @ORM\Column(type="smallint")
     * @Groups({"get", "post"})
     * @var int
     */
    private $value;

    /**
     * @var Course
     * @Groups({"get", "post"})
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="ratings")
     */
    private $course;

    public function __construct(string $text, int $value, Course $course)
    {
        Assertion::between($value, 1, 5);

        $this->text = $text;
        $this->value = $value;
        $this->course = $course;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getCourse(): Course
    {
        return $this->course;
    }

    public function setCourse(Course $course)
    {
        $this->course = $course;
    }
}
