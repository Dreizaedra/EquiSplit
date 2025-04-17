<?php

namespace App\Repository;

use App\Entity\Travel;
use App\Entity\User;
use App\Entity\UserExpense;
use App\Enum\UserStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserExpense>
 */
class UserExpenseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserExpense::class);
    }

    public function findByUserAndTravel(User $user, Travel $travel): array
    {
        return $this->createQueryBuilder('ue')
            ->andWhere('ue.user = :user')
            ->andWhere('ue.status = :status')
            ->leftJoin('ue.expense', 'e')
            ->andWhere('e.travel = :travel')
            ->setParameter('user', $user)
            ->setParameter('travel', $travel)
            ->setParameter('status', UserStatus::ACCEPTED)
            ->getQuery()
            ->getResult();
    }
}
