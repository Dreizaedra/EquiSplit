<?php

namespace App\DataFixtures;

use App\Entity\Expense;
use App\Entity\Travel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ExpenseFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $expense1 = new Expense();
        $expense1->setName('Test expense 1')
            ->setTravel($this->getReference('travel', Travel::class))
            ->setPrice(10000);

        $expense2 = new Expense();
        $expense2->setName('Test expense 2')
            ->setTravel($this->getReference('travel', Travel::class))
            ->setPrice(20000);

        $manager->persist($expense1);
        $manager->persist($expense2);

        $manager->flush();

        $this->setReference('expense1', $expense1);
        $this->setReference('expense2', $expense2);
    }

    public function getDependencies(): array
    {
        return [
            TravelFixtures::class,
        ];
    }
}
