<?php

namespace App\Infrastructure\Services\BigQuery\StackOverflow;

use Google\Cloud\BigQuery\BigQueryClient;

class StackOverflowClient
{
    private string $credentialsPath;
    private string $datasetId;

    public function __construct(string $credentialsPath, string $datasetId)
    {
        $this->credentialsPath = $credentialsPath;
        $this->datasetId = $datasetId;
    }

    public function getAllPosts()
    {
        $tableId = 'stackoverflow.posts_questions';

        $bigQuery = new BigQueryClient([
            'keyFilePath' => $this->credentialsPath,
        ]);

        $query = "
            SELECT 
                id, 
                title, 
                body, 
                tags, 
                creation_date 
            FROM 
                `$this->datasetId.$tableId` 
            LIMIT 100
        ";

        $queryJob = $bigQuery->query($query);
        $results = $bigQuery->runQuery($queryJob);

        return $results;
    }

    public function getAllUsers()
    {
        $tableId = 'stackoverflow.users';

        $bigQuery = new BigQueryClient([
            'keyFilePath' => $this->credentialsPath,
        ]);

        $query = "
            SELECT 
                id, 
                display_name, 
                reputation, 
                creation_date 
            FROM 
                `$this->datasetId.$tableId` 
            LIMIT 100
        ";

        $queryJob = $bigQuery->query($query);
        $results = $bigQuery->runQuery($queryJob);

        return $results;
    }
}