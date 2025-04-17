<?php

namespace App\Controller;

use App\Entity\Travel;
use App\Entity\UserExpense;
use App\Entity\UserTravel;
use App\Repository\UserExpenseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class TravelApiController extends AbstractController
{
    public function __invoke(Travel $travel, UserExpenseRepository $userExpenseRepository): JsonResponse
    {
        $response = new JsonResponse();
        $response->setStatusCode(Response::HTTP_OK);

        // Fetching users participating in the travel
        $users = array_map(fn (UserTravel $userTravel) => $userTravel->getUser(), $travel->getUserTravel()->toArray());

        $data = [];
        foreach ($users as $user) {
            $userExpenses = $userExpenseRepository->findByUserAndTravel($user, $travel);

            $totalDue = array_sum(array_map(function (UserExpense $userExpense) {
                $expense = $userExpense->getExpense();

                return $expense->getPrice() / $expense->getUserCount();
            }, $userExpenses));

            $totalPaid = array_sum(array_map(fn (UserExpense $userExpense) => $userExpense->getPaidAmount(), $userExpenses));

            $data[$user->getId()] = [
                'name' => $user->getPseudo(),
                'email' => $user->getEmail(),
                'balance' => $totalDue - $totalPaid,
            ];
        }

        return $response->setData([
            'users' => $data,
        ]);
    }
}
