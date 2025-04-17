<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setPseudo('admin')
            ->setEmail('admin@admin.fr')
            // password : admin
            ->setPassword('$2y$10$RFuIA6GGwN0hWIbOioyoT.2d5lp7p7Ao7TXghh5V7G8JaOURKJYmu')
        ;

        $user2 = new User();
        $user2->setPseudo('user')
            ->setEmail('user@user.fr')
            // password : admin
            ->setPassword('$2y$10$RFuIA6GGwN0hWIbOioyoT.2d5lp7p7Ao7TXghh5V7G8JaOURKJYmu');

        $manager->persist($user1);
        $manager->persist($user2);

        $manager->flush();

        $this->setReference('user1', $user1);
        $this->setReference('user2', $user2);
    }
}
