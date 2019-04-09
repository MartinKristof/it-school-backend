<?php declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
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
 * @ORM\Entity(repositoryClass="App\Repository\SummaryRepository")
 */
class Summary
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
     * @ORM\Column(type="string")
     * @Groups({"get", "post"})
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"get", "post"})
     * @var string|null
     */
    private $note;

    public function __construct(string $title, ?string $note)
    {
        $this->title = $title;
        $this->note = $note;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }


    public function getNote(): ?string
    {
        return $this->note;
    }
}
