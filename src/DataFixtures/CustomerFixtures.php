<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CustomerFixtures extends Fixture
{
    public const NAME = [
        [
            'name' => 'Facebook'
        ],
        [
            'name' => 'Amazon'
        ],
        [
            'name' => 'Google'
        ],
        [
            'name' => 'Apple'
        ],
        [
            'name' => 'Microsoft'
        ],
        [
            'name' => 'SensioLab'
        ]
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::NAME as $data) {
            $customer = new Customer();
            $customer->setName($data['name']);
            $manager->persist($customer);
        }
        $manager->flush();
    }
}
