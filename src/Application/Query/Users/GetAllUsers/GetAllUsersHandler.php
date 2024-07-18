<?php
namespace App\Application\Query\Users\GetAllUsers;

use App\Infrastructure\Services\BigQuery\StackOverflow\StackOverflowClient;

class GetAllUsersHandler
{
    private StackOverflowClient $client;
    public function __construct(StackOverflowClient $client)
    {
        $this->client = $client;
    }

    public function __invoke(){
        $data = $this->client->getAllUsers();
        return $data;
    }
}