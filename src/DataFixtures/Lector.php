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
        $user = $this->getReference(sprintf("%s_%s", User::USER_REF, 3));
        $lector = new LectorEntity($user);

        /** @var Tag $tag */
        $tag = $this->getReference(sprintf("%s_%s", Course::TAG_REFERENCE, 0));
        $lector->addSpecialization($tag);

        $manager->persist($lector);

        $manager->flush();

        /** @var UserEntity $user */
        $user = $this->getReference(sprintf("%s_%s", User::USER_REF, 4));
        $lector = new LectorEntity($user);

        /** @var Tag $tag */
        $tag = $this->getReference(sprintf("%s_%s", Course::TAG_REFERENCE, 1));
        $lector->addSpecialization($tag);

        $manager->persist($lector);

        $manager->flush();

        /** @var UserEntity $user */
        $user = $this->getReference(sprintf("%s_%s", User::USER_REF, 5));
        $lector = new LectorEntity($user);

        /** @var Tag $tag */
        $tag = $this->getReference(sprintf("%s_%s", Course::TAG_REFERENCE, 2));
        $lector->addSpecialization($tag);

        $manager->persist($lector);

        $manager->flush();

        /** @var UserEntity $user */
        $user = $this->getReference(sprintf("%s_%s", User::USER_REF, 0));
        $lector = new LectorEntity($user);

        /** @var Tag $tag */
        $tag = $this->getReference(sprintf("%s_%s", Course::TAG_REFERENCE, 3));
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
