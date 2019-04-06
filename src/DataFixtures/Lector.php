<?php

namespace App\DataFixtures;

use App\Entity\Lector as LectorEntity;
use App\Entity\Tag as TagEntity;
use App\Entity\User as UserEntity;
use App\Entity\Course as CourseEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class Lector extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        for ($i = 0; $i < 4; $i++) {
            /** @var UserEntity $user */
            $user = $this->getReference(sprintf("%s_%s", User::USER_REF, $i + 3));
            $lector = new LectorEntity($user);

            /** @var TagEntity $tag */
            $tag = $this->getReference(sprintf("%s_%s", Tag::TAG_REFERENCE, $i));

            /** @var CourseEntity $course */
            $course = $this->getReference(sprintf("%s_%s", COURSE::COURSE_REFERENCE, $i));

            $lector->addSpecialization($tag);
            $lector->addTeachedCourse($course);

            $manager->persist($lector);
        }

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
