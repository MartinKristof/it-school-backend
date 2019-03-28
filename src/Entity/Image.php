<?php declare(strict_types=1);

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
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $urlPath;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $title;

    public function __construct(string $urlPath, string $title)
    {
        $this->urlPath = $urlPath;
        $this->title = $title;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUrlPath(): string
    {
        return $this->urlPath;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
