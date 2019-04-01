<?php

namespace App\DataFixtures;

use App\Entity\User as UserEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class User extends Fixture implements OrderedFixtureInterface
{
    const USER_REF = 'user-ref';

    public function load(ObjectManager $manager)
    {
        $user = new UserEntity('user', 'username');

        $user->setPassword('1234');
        $user->setApiKey('test_api_key-2');

        $this->addReference(self::USER_REF, $user);

        $manager->persist($user);

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
