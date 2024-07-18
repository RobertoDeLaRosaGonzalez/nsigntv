<?php

namespace App\Infrastructure\Controller\Api\Users\GetAllUsers;

use App\Application\Query\Users\GetAllUsers\GetAllUsersHandler;
use App\Application\Query\Users\GetAllUsers\GetAllUsersQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GetAllUsersController extends AbstractController
{

    private GetAllUsersHandler $getAllUsersHandler;

    public function __construct(GetAllUsersHandler $getAllUsersHandler)
    {
        $this->getAllUsersHandler = $getAllUsersHandler;
    }

    #[Route('/api/users/all', name: 'api_users_all', methods: ['GET'])]
    public function getAllUsers(Request $request) : JsonResponse
    {
        $command = new GetAllUsersQuery(
        );
        $results = $this->getAllUsersHandler->__invoke($command);


        $users = [];
        foreach ($results as $row) {
            $users[] = [
                'id' => $row['id'],
                'display_name' => $row['display_name'],
                'reputation' => $row['reputation'],
                'creation_date' => $row['creation_date'],
            ];
        }

        return new JsonResponse($users);
    }
}