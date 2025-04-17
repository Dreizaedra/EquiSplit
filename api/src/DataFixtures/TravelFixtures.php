<?php

namespace App\DataFixtures;

use App\Entity\Travel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TravelFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $travel = new Travel();
        $travel->setName('Test travel');

        $manager->persist($travel);

        $manager->flush();

        $this->setReference('travel', $travel);
    }
}
