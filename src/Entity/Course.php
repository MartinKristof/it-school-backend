<?php declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CourseRepository")
 */
class Course
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
    private $title;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     * @var float
     */
    private $price;

    /**
     * Owning side
     *
     * @ORM\ManyToMany(targetEntity="Address")
     * @ORM\JoinTable(name="courses_addresses",
     *     joinColumns={@ORM\JoinColumn(name="course_id", referencedColumnName="id", onDelete="CASCADE")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="address_id", referencedColumnName="id", onDelete="CASCADE")}
     * )
     * @var ArrayCollection|Address[]
     */
    private $addresses;

    /**
     * @ORM\Column(type="float")
     * @var float
     */
    private $duration;

    /**
     * Owning side
     *
     * @ORM\ManyToMany(targetEntity="Image")
     * @ORM\JoinTable(name="courses_images",
     *     joinColumns={@ORM\JoinColumn(name="course_id", referencedColumnName="id", onDelete="CASCADE")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="image_id", referencedColumnName="id", onDelete="CASCADE")}
     * )
     * @var ArrayCollection|Image[]
     */
    private $images;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $content;

    /**
     * @var bool
     */
    private $favorite = false;

    /**
     * Owning side
     *
     * @ORM\OneToMany(targetEntity="Rating", mappedBy="course", cascade={"persist"})
     * @var ArrayCollection|Rating[]
     */
    private $ratings;

    /**
     * Owning side
     *
     * @ORM\ManyToMany(targetEntity="Tag")
     * @ORM\JoinTable(name="courses_tags",
     *     joinColumns={@ORM\JoinColumn(name="course_id", referencedColumnName="id", onDelete="CASCADE")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id", onDelete="CASCADE")}
     * )
     * @var ArrayCollection|Tag[]
     */
    private $tags;

    /**
     * Owning side
     *
     * @ORM\OneToOne(targetEntity="Summary")
     * @var Summary
     */
    private $summary;

    public function __construct(
        string $title,
        string $description,
        float $price,
        float $duration,
        string $content,
        Summary $summary
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->addresses = new ArrayCollection();
        $this->duration = $duration;
        $this->images = new ArrayCollection();
        $this->content = $content;
        $this->ratings = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->summary = $summary;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return Address[]
     */
    public function getAddresses(): array
    {
        return $this->addresses->toArray();
    }

    public function getDuration(): float
    {
        return $this->duration;
    }

    /**
     * @return Image[]
     */
    public function getImages(): array
    {
        return $this->images->toArray();
    }

    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return Rating[]
     */
    public function getRatings(): array
    {
        return $this->ratings->toArray();
    }

    /**
     * @return Tag[]
     */
    public function getTags(): array
    {
        return $this->tags->toArray();
    }

    public function getSummary()
    {
        return $this->summary;
    }

    public function isFavorite(): bool
    {
        return $this->favorite;
    }

    public function addAddress(Address $address)
    {
        $this->addresses->add($address);
    }

    public function addImage(Image $image)
    {
        $this->images->add($image);
    }

    public function addRating(Rating $rating)
    {
        $this->ratings->add($rating);
    }

    public function addTag(Tag $tag)
    {
        $this->tags->add($tag);
    }

    public function setFavorite(bool $favorite)
    {
        $this->favorite = $favorite;
    }

}
