<?php

namespace App\DataFixtures;

use App\Entity\DomainName;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DomainNameFixtures extends Fixture implements DependentFixtureInterface
{
    public const NDD = [
        [
        'name' => 'ot-autrans.fr',
        'localisation' => 'OVH',
        ],
        [
            'name' => 'graphedron.fr',
            'localisation' => 'OVH',
        ],
        [
            'name' => 'posterinmypocket.fr',
            'localisation' => 'OVH',
        ],
        [
            'name' => 'test1.fr',
            'localisation' => 'OVH',
        ],
        [
            'name' => 'test2.fr',
            'localisation' => 'OVH',
        ],
        [
            'name' => 'test3.fr',
            'localisation' => 'OVH',
        ],
        [
            'name' => 'test4.fr',
            'localisation' => 'OVH',
        ],
        [
            'name' => 'test6.fr',
            'localisation' => 'OVH',
        ],
        [
            'name' => 'test7.fr',
            'localisation' => 'OVH',
        ],
    ];
    public function getDependencies(): array
    {
        return [UserFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        foreach (self::NDD as $data){
            $ndd = new DomainName();
            $holder = random_int(1,3);
            $ndd->setName($data['name'])
                ->setLocalisation($data['localisation'])
                ->setHolder($manager->find('App:User', $holder));
            $manager->persist($ndd);
        }

        $manager->flush();
    }
}
