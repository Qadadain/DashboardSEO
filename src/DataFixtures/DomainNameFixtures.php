<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DomainNameFixtures extends Fixture
{
    public const NDD = [
        [
        'name' => 'ot-autrans.fr',
        'localisation' => 'OVH',
            'expirationDate' => '2020-08-21 '
        ],
        [
            'name' => 'graphedron.fr',
            'localisation' => 'OVH',
            'expirationDate' => '2020-08-21 '
        ],
        [
            'name' => 'posterinmypocket.fr',
            'localisation' => 'OVH',
            'expirationDate' => '2020-08-21 '
        ],
        [
            'name' => 'test1.fr',
            'localisation' => 'OVH',
            'expirationDate' => '2020-08-21 '
        ],
        [
            'name' => 'test2.fr',
            'localisation' => 'OVH',
            'expirationDate' => '2020-08-21 '
        ],
        [
            'name' => 'test3.fr',
            'localisation' => 'OVH',
            'expirationDate' => '2020-08-21 '
        ],
        [
            'name' => 'test4.fr',
            'localisation' => 'OVH',
            'expirationDate' => '2020-08-21 '
        ],
        [
            'name' => 'test6.fr',
            'localisation' => 'OVH',
            'expirationDate' => '2020-08-21 '
        ],
        [
            'name' => 'test7.fr',
            'localisation' => 'OVH',
            'expirationDate' => '2020-08-21 '
        ],
    ];
    public function getDependencies()
    {
        return [UserFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
