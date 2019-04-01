<?php

namespace App\DataFixtures;

use App\Entity\Student as StudentEntity;
use App\Entity\User as UserEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class Student extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /** @var UserEntity $user */
        $user = $this->getReference(User::USER_REF);
        $student = new StudentEntity($user);

        $manager->persist($student);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 3;
    }
}
