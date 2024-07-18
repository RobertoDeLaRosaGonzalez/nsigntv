<?php
namespace App\Application\Query\Posts\GetAllPosts;

use App\Infrastructure\Services\BigQuery\StackOverflow\StackOverflowClient;

class GetAllPostsHandler
{
    private StackOverflowClient $client;
    public function __construct(StackOverflowClient $client)
    {
        $this->client = $client;
    }

    public function __invoke(){
        $data = $this->client->getAllPosts();
        return $data;
    }
}