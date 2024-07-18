<?php

namespace App\Infrastructure\Controller\Api\Posts\GetAllPosts;

use App\Application\Query\Posts\GetAllPosts\GetAllPostsHandler;
use App\Application\Query\Posts\GetAllPosts\GetAllPostsQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GetAllPostsController extends AbstractController
{

    private GetAllPostsHandler $getAllPostsHandler;

    public function __construct(GetAllPostsHandler $getAllPostsHandler)
    {
        $this->getAllPostsHandler = $getAllPostsHandler;
    }

    #[Route('/api/posts/all', name: 'api_posts_all', methods: ['GET'])]
    public function getAllPosts(Request $request) : JsonResponse
    {
        $command = new GetAllPostsQuery(
        );
        $results = $this->getAllPostsHandler->__invoke($command);


        $posts = [];
        foreach ($results as $row) {
            $posts[] = [
                'id' => $row['id'],
                'title' => $row['title'],
                'body' => $row['body'],
                'tags' => $row['tags'],
                'creation_date' => $row['creation_date'],
            ];
        }

        return new JsonResponse($posts);
    }
}