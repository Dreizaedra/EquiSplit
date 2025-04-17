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
        $expense = new Expense();
        $expense->setName('Test expense')
            ->setTravel($this->getReference('travel', Travel::class))
            ->setPrice(10000);

        $manager->persist($expense);

        $manager->flush();

        $this->setReference('expense', $expense);
    }

    public function getDependencies(): array
    {
        return [
            TravelFixtures::class,
        ];
    }
}
