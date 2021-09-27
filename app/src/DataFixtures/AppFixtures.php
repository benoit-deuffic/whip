<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setLogin('admin');
        $user->setName('Admin');
        $user->setLastname('ADMIN');
        $user->setPassword('123456');
        $user->setRoles(['role'=>'ROLE_SUPERADMIN']);
        $user->setStatus(User::VALIDATED);
        $user->setEmail('admin@nodomain.com');
        $manager->persist($user);
        $manager->flush();
    }
}
