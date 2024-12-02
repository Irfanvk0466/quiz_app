<?php

namespace App\Services;
use GuzzleHttp\Client;


class APIService
{
    public function fetchCategories()
    {
        $apiUrl = "https://the-trivia-api.com/api/categories";
        try {
            $client = new Client();
            $response = $client->get($apiUrl, [
                'verify' => false,
            ]);

            if  ($response->getStatusCode() == 200) {
                return json_decode($response->getBody(), true);
            } else {
                return [];
            }

        } catch (\Exception $e) {
            return [];
        }
    }
    public function fetchQuestionsByCategory($category)
    {
        $apiUrl = "https://the-trivia-api.com/api/questions?limit=15&categories=" . urlencode($category);
        try {
            $client = new Client();
            $response = $client->get($apiUrl, [
                'verify' => false,
            ]);

            if  ($response->getStatusCode() == 200) {
                return json_decode($response->getBody(), true);

            } else {
                return [];
            }

        } catch (\Exception $e) {
            return [];
        }
    }

    public function fetchQuestionById($questionId)
    {
        $apiUrl = "https://the-trivia-api.com/api/question/" . $questionId;
        try {
            $client = new Client();
            $response = $client->get($apiUrl, [
                'verify' => false,
            ]);

            if  ($response->getStatusCode() == 200) {
                return json_decode($response->getBody(), true);
            } else {
                return [];
            }

        } catch (\Exception $e) {
            return [];
        }
    }
}
