<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    public const USER = [
        'quentin.adadain@gmail.com' => [
            'roles' => ['ROLE_ADMIN'],
            'firstName' => 'Quentin',
            'lastName' => 'Adadain',
            'pseudo' => 'Rolls'
        ],
        'hellsaya@gmail.com' => [
            'roles' => ['ROLE_ADMIN'],
            'firstName' => 'Yoann',
            'lastName' => 'Boucher',
            'pseudo' => 'Hellsaya'
        ],
        'orta@gmail.com' => [
            'roles' => ['ROLE_ADMIN'],
            'firstName' => 'Arnaud',
            'lastName' => 'Allourche',
            'pseudo' => 'Orta'
        ]

    ];


    public const PASSWORD_TEST = 'admin47';

    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        foreach (self::USER as $email => $data) {
            $user = new User();
            $user->setEmail($email)
                ->setRoles($data['roles'])
                ->setFirstName($data['firstName'])
                ->setLastName($data['lastName'])
                ->setPseudo($data['pseudo'])
                ->setPassword($this->passwordEncoder->encodePassword($user, self::PASSWORD_TEST));

            $manager->persist($user);
        }
        $manager->flush();
    }
}
