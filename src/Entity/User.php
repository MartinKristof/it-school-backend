<?php declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"student": "Student", "lector": "Lector"})
 */
abstract class User
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

    public function setPasswordHash(string $password, int $cost = 13): void
    {
        $options = ['cost' => $cost];
        $passwordHash = (string) password_hash($password, PASSWORD_BCRYPT, $options);
        $this->setPasswordHash($passwordHash);
    }

    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->getPasswordHash());
    }

    public function getPassword(): string
    {
        return $this->passwordHash;
    }
}
