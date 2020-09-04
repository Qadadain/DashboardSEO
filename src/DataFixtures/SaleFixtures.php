<?php

namespace App\DataFixtures;

use App\Entity\Sale;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SaleFixtures extends Fixture  implements DependentFixtureInterface
{
    public const SALE = [
        [
            'link' => 'link1',
            'target' => 'cibleclient1'
        ],
        [
            'link' => 'link2',
            'target' => 'cibleclient2'
        ],
        [
            'link' => 'link3',
            'target' => 'cibleclient3'
        ],
        [
            'link' => 'link4',
            'target' => 'cibleclient4'
        ],
        [
            'link' => 'link5',
            'target' => 'cibleclient6'
        ],
        [
            'link' => 'link6',
            'target' => 'cibleclient6'
        ],
        [
            'link' => 'link7',
            'target' => 'cibleclient7'
        ],
        [
            'link' => 'link8',
            'target' => 'cibleclient8'
        ],
        [
            'link' => 'link9',
            'target' => 'cibleclient9'
        ],
        [
            'link' => 'link10',
            'target' => 'cibleclient10'
        ],
        [
            'link' => 'link11',
            'target' => 'cibleclient11'
        ],
        [
            'link' => 'link12',
            'target' => 'cibleclient12'
        ],
        [
            'link' => 'link12',
            'target' => 'cibleclient12'
        ],
        [
            'link' => 'link13',
            'target' => 'cibleclient13'
        ],
    ];
    public function getDependencies(): array
    {
        return [UserFixtures::class, CustomerFixtures::class, DomainNameFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        foreach (self::SALE as $data) {
            $sale = new Sale();
            $custoUser = random_int(1, 3);
            $ndd = random_int(1, 8);
            $price = random_int(50, 120);
            $saleNumber = random_int(10000, 20000);
            $sale->setCustomer($manager->find('App:Customer', $custoUser));
            $sale->setDomainName($manager->find('App:DomainName', $ndd));
            $sale->setUser($manager->find('App:User', $custoUser));
            $sale->setPrice($price);
            $sale->setSaleNumber($saleNumber);
            $sale->setLink($data['link']);
            $sale->setTarget($data['target']);

            $manager->persist($sale);
        }
        $manager->flush();
    }
}
