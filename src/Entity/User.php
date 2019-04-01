<?php declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Serializable;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, Serializable
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
    private $name;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $username;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $passwordHash;

    /**
     * @ORM\Column(type="string", length=64, unique=true))
     */
    private $apiKey;


    public function __construct(string $name, string $username)
    {
        $this->name = $name;
        $this->username = $username;
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
