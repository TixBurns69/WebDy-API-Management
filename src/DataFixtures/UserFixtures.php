<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordEncoder;
    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('tix@burns.mg');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->passwordEncoder->hashPassword(
        $user,
        'azerty'
    ));
        $manager->persist($user);
        $user2 = new User();
        $user2->setEmail('tix2@burns.mg');
        $user2->setRoles('ROLE_USER');
        $user2->setPassword($this->passwordEncoder->hashPassword(
        $user2,
        'qwerty'
    ));
        $manager->persist($user2);
        $manager->flush();
    }

}
