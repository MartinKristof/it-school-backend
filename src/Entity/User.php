<?php declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Serializable;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={
 *       "get"={
 *          "access_control"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')",
 *           "normalization_context"={
 *             "groups"={"get"}
 *           }
 *       },
 *       "post"={
 *          "denormalization_context"={
 *             "groups"={"post"}
 *           },
 *           "normalization_context"={
 *              "groups"={"get"}
 *           }
 *       }
 *     },
 *     itemOperations={
 *      "get"={
 *         "access_control"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')",
 *         "normalization_context"={
 *            "groups"={"get"}
 *          }
 *       },
 * })
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, Serializable
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
     * @var string
     * @Groups({"get", "post"})
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     * @Groups({"get", "post"})
     * @var string
     */
    private $surname;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Groups({"get", "post"})
     * @var string
     */
    private $username;

    /**
     * @ORM\Column(type="string")
     * @Groups({"post"})
     * @var string
     */
    private $passwordHash;

    /**
     * @ORM\Column(type="string", length=64, unique=true))
     * @Groups({"post"})
     */
    private $apiKey;

    /**
     * @ORM\ManyToOne(targetEntity="Image")
     * @Groups({"get", "post"})
     * @var Image
     */
    private $image;


    public function __construct(string $name, string $username, string $surname)
    {
        $this->name = $name;
        $this->username = $username;
        $this->surname = $surname;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname)
    {
        $this->surname = $surname;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function setPassword(string $password, int $cost = 13): void
    {
        $options = ['cost' => $cost];
        $passwordHash = (string) password_hash($password, PASSWORD_BCRYPT, $options);
        $this->setPasswordHash($passwordHash);
    }

    public function setPasswordHash(string $passwordHash): void
    {
        $this->passwordHash = $passwordHash;
    }

    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->getPasswordHash());
    }

    public function getPassword(): string
    {
        return $this->passwordHash;
    }

    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image)
    {
        $this->image = $image;
    }

    public function setApiKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return ['ROLE_API'];
    }

    /**
     * @return null The salt
     */
    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
    }

    /** @see Serializable::serialize() */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->passwordHash,
            $this->apiKey,
            // see section on salt below
            // $this->salt,
        ]);
    }

    /** @see Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->passwordHash,
            $this->apiKey,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized, ['allowed_classes' => false]);
    }
}
