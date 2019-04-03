<?php

namespace App\DataFixtures;

use App\Entity\Lector as LectorEntity;
use App\Entity\Tag;
use App\Entity\User as UserEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class Lector extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /** @var UserEntity $user */
        $user = $this->getReference(User::USER_REF);
        $lector = new LectorEntity($user);

        /** @var Tag $tag */
        $tag = $this->getReference(Course::TAG_REFERENCE);
        $lector->addSpecialization($tag);

        $manager->persist($lector);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 4;
    }
}
