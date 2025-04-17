<?php

namespace App\DataFixtures;

use App\Entity\Expense;
use App\Entity\User;
use App\Entity\UserExpense;
use App\Enum\UserStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UserExpenseFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $userExpense1 = new UserExpense();
        $userExpense1->setUser($this->getReference('user1', User::class))
            ->setExpense($this->getReference('expense', Expense::class))
            ->setStatus(UserStatus::ACCEPTED)
            ->setPaidAmount(10000);

        $userExpense2 = new UserExpense();
        $userExpense2->setUser($this->getReference('user2', User::class))
            ->setExpense($this->getReference('expense', Expense::class))
            ->setStatus(UserStatus::ACCEPTED);

        $manager->persist($userExpense1);
        $manager->persist($userExpense2);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            ExpenseFixtures::class,
        ];
    }
}
