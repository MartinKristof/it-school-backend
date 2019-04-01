<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Course as CourseEntity;
use App\Entity\Image;
use App\Entity\Rating;
use App\Entity\Summary;
use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class Course extends Fixture implements OrderedFixtureInterface
{
    public const TAG_REFERENCE = 'tag-user';

    public function load(ObjectManager $manager)
    {
        $summary = new Summary('summary', 'note');
        $manager->persist($summary);

        $image = new Image(
            'http://kitlab.pef.czu.cz/1819zs/ete89e/02/static/images/classroom-2093743_1920.jpg',
            'Java - Od začátečníka k expertovi - Učebna'
        );

        $manager->persist($image);

        $address = new Address('U Vody', 'Prague');
        $manager->persist($address);

        $tag = new Tag('back-end');
        $manager->persist($tag);
        $this->addReference(self::TAG_REFERENCE, $tag);

        $course = new CourseEntity('title', 'desct', 1000, 20, 'content', $summary);
        $course->addAddress($address);
        $course->addImage($image);
        $course->addTag($tag);

        $rating = new Rating('Good', 3, $course);
        $course->addRating($rating);

        $manager->persist($course);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 2;
    }
}
