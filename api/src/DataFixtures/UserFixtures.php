<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setPseudo('admin')
            ->setEmail('admin@admin.fr')
            // password : admin
            ->setPassword('$2y$10$RFuIA6GGwN0hWIbOioyoT.2d5lp7p7Ao7TXghh5V7G8JaOURKJYmu')
        ;

        $manager->persist($user);

        $manager->flush();
    }
}
