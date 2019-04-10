<?php

namespace App\DataFixtures;

use App\Entity\Tag as TagEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class Tag extends Fixture implements OrderedFixtureInterface
{
    const TAG_REFERENCE = 'tag-ref';

    public function load(ObjectManager $manager)
    {
        $tagArray = [
            new TagEntity('front-end'),
            new TagEntity('back-end'),
            new TagEntity('front-end'),
            new TagEntity('back-end'),
        ];

        for ($i = 0; $i < 4; $i++) {

            $this->addReference(sprintf("%s_%s", self::TAG_REFERENCE, $i), $tagArray[$i]);

            $manager->persist($tagArray[$i]);

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
        return 2;
    }
}
