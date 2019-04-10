<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\User as UserEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class User extends Fixture implements OrderedFixtureInterface
{
    const USER_REF = 'user-ref';

    public function load(ObjectManager $manager)
    {

        $nameArray = ['Steve', 'Tony', 'Bruce', 'Natasha', 'Thor', 'Peter', 'Stephen', 'Erik'];

        $surnameArray = ['Rodgers', 'Stark', 'Banner', 'Romanova', 'Odinson', 'Parker', 'Strange', 'Killmonger'];

        $usernameArray = [
            'rodgers@mail.com',
            'stark@mail.com',
            'banner@mail.com',
            'romanova@mail.com',
            'odinson@mail.com',
            'parker@mail.com',
            'strange@mail.com',
            'killmonger@mail.com',
        ];

        $passwordArray = ['1111', '2222', '3333', '4444', '5555', '6666', '7777', '8888'];

        $imageArray = [
            new Image('http://kitlab.pef.czu.cz/1819zs/ete89e/02/static/images/lector.jpg"',
                'Steve Rogers'),
            new Image('http://kitlab.pef.czu.cz/1819zs/ete89e/02/static/images/lector.jpg"',
                'Tony Start'),
            new Image('http://kitlab.pef.czu.cz/1819zs/ete89e/02/static/images/lector.jpg"',
                'Bruce Banner'),
            new Image('http://kitlab.pef.czu.cz/1819zs/ete89e/02/static/images/lector.jpg"',
                'Natasha Romanova'),
            new Image('http://kitlab.pef.czu.cz/1819zs/ete89e/02/static/images/lector.jpg"',
                'Thor Odinson'),
            new Image('http://kitlab.pef.czu.cz/1819zs/ete89e/02/static/images/lector.jpg"',
                'Peter Parker'),
            new Image('http://kitlab.pef.czu.cz/1819zs/ete89e/02/static/images/lector.jpg"',
                'Stephen Strange'),
            new Image('http://kitlab.pef.czu.cz/1819zs/ete89e/02/static/images/lector.jpg"',
                'Erik Killmonger'),
        ];

        $keyApidArray = [
            'test_api_key-1',
            'test_api_key-2',
            'test_api_key-3',
            'test_api_key-4',
            'test_api_key-5',
            'test_api_key-6',
            'test_api_key-7',
            'test_api_key-8',
        ];

        for ($i = 0; $i < 8; $i++) {
            $user = new UserEntity($nameArray[$i], $surnameArray[$i], $usernameArray[$i]);

            $user->setPassword($passwordArray[$i]);
            $user->setApiKey($keyApidArray[$i]);

            $manager->persist($imageArray[$i]);

            $user->setImage($imageArray[$i]);

            $this->addReference(sprintf("%s_%s", self::USER_REF, $i), $user);

            $manager->persist($user);
            $manager->flush();
        }
    }

    public function getOrder()
    {
        return 1;
    }
}
