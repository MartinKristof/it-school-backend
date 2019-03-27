<?php

namespace App\Entity;

use Assert\Assertion;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RatingRepository")
 */
class Rating
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $text;

    /**
     * @ORM\Column(type="smallint")
     * @var int
     */
    private $value;

    public function __construct(string $text, int $value)
    {
        Assertion::between($value, 1,5);

        $this->text = $text;
        $this->value = $value;
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
}
