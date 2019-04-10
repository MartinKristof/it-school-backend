<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Course as CourseEntity;
use App\Entity\Tag as TagEntity;
use App\Entity\Image;
use App\Entity\Rating;
use App\Entity\Summary;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class Course extends Fixture implements OrderedFixtureInterface
{
    const COURSE_REFERENCE = 'course-ref';

    public function load(ObjectManager $manager)
    {

        $imageArray = [
            new Image('http://kitlab.pef.czu.cz/1819zs/ete89e/02/static/images/classroom-2093743_1920.jpg',
                'Java - Od začátečníka k expertovi - Učebna'),
            new Image('http://kitlab.pef.czu.cz/1819zs/ete89e/02/static/images/classroom-2093743_1920.jpg',
                'Java - Od začátečníka k expertovi - Učebna'),
            new Image('http://kitlab.pef.czu.cz/1819zs/ete89e/02/static/images/classroom-2093743_1920.jpg',
                'Java - Od začátečníka k expertovi - Učebna'),
            new Image('http://kitlab.pef.czu.cz/1819zs/ete89e/02/static/images/classroom-2093743_1920.jpg',
                'Java - Od začátečníka k expertovi - Učebna'),
        ];

        $addressArray = [
            new Address('U Vody', 'Prague'),
            new Address('Falesna 123', 'Brno'),
            new Address('U Pergamnky 69', 'Prague'),
            new Address('Dělnická 11', 'Prague'),
        ];

        $summaryArray = [
            new Summary('Pro začátečníky', ''),
            new Summary('Pro Mírně pokročilé', ''),
            new Summary('Pro středně pokročilé', ''),
            new Summary('Pro pokročilé', ''),
        ];

        $titleArray = [
            "Java - Mírně pokročilý",
            "Java - Středně pokročilý",
            "Python - Mírně pokročilý",
            "Pyton - Středně pokročilý",
        ];

        $priceArray = [1000, 2000, 3000, 4000];

        $durationArray = [10, 20, 30, 40];

        $ratingArray = ["Good", "Awesome", "Well done", "Great"];
        $ratingValueArray = [1, 2, 3, 4];

        $contentArray = [
            "Lekce budou probíhat se zaměřením na odlišnoti jazyka",
            "Lekce probíhají v interaktivních učebnách",
            "Je potřeba si vzít s sebou NTB",
            "Stolní počítače jsou přítomny na místě",
        ];

        for ($i = 0; $i < 4; $i++) {
            $manager->persist($summaryArray[$i]);
            $manager->persist($imageArray[$i]);
            $manager->persist($addressArray[$i]);

            $course = new CourseEntity(
                $titleArray[$i],
                'desct',
                $priceArray[$i],
                $durationArray[$i],
                $contentArray[$i],
                $summaryArray[$i]
            );
            $course->addAddress($addressArray[$i]);
            $course->addImage($imageArray[$i]);

            /** @var TagEntity $tag */
            $tag = $this->getReference(sprintf("%s_%s", TAG::TAG_REFERENCE, $i));
            $course->addTag($tag);

            $rating = new Rating($ratingArray[$i], $ratingValueArray[$i], $course);
            $course->addRating($rating);

            $this->addReference(sprintf("%s_%s", self::COURSE_REFERENCE, $i), $course);

            $manager->persist($course);

            $manager->flush();
        }
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
