<?php

namespace App\DataFixtures;

use App\Entity\Travel;
use App\Entity\User;
use App\Entity\UserTravel;
use App\Enum\UserStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UserTravelFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $userTravel1 = new UserTravel();
        $userTravel1->setStatus(UserStatus::ACCEPTED)
            ->setUser($this->getReference('user1', User::class))
            ->setTravel($this->getReference('travel', Travel::class))
        ;

        $userTravel2 = new UserTravel();
        $userTravel2->setStatus(UserStatus::ACCEPTED)
            ->setUser($this->getReference('user2', User::class))
            ->setTravel($this->getReference('travel', Travel::class))
        ;

        $manager->persist($userTravel1);
        $manager->persist($userTravel2);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            TravelFixtures::class,
        ];
    }
}
