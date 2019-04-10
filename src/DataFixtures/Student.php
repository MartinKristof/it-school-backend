<?php

namespace App\DataFixtures;

use App\Entity\Student as StudentEntity;
use App\Entity\User as UserEntity;
use App\Entity\Course as CourseEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class Student extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /** @var UserEntity $user */
        $user = $this->getReference(sprintf("%s_%s", User::USER_REF, 0));
        $student = new StudentEntity($user);

        /** @var CourseEntity $course */
        $course = $this->getReference(sprintf("%s_%s", COURSE::COURSE_REFERENCE, 0));
        $student->addFavoriteCourse($course);

        $manager->persist($student);

        $manager->flush();


        $user = $this->getReference(sprintf("%s_%s", User::USER_REF, 1));
        $student = new StudentEntity($user);

        $manager->persist($student);

        $manager->flush();

        $user = $this->getReference(sprintf("%s_%s", User::USER_REF, 2));
        $student = new StudentEntity($user);

        $manager->persist($student);

        $manager->flush();

        $user = $this->getReference(sprintf("%s_%s", User::USER_REF, 3));
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
        return 5;
    }
}
