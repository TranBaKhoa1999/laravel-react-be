<?php

namespace App\Services;

use Cloudstudio\Ollama\Facades\Ollama;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class OllamaService
{
    public function getAssistantResponse(string $prompt): string
    {
        try {
            $response = Ollama::agent(env('OLLAMA_DEFAULT_PROMPT'))
                ->prompt($prompt)
                ->ask();
            return $response['response'];
        } catch (RequestException $e) {
            throw new \Exception('Lỗi khi gọi Ollama API: ' . $e->getMessage());
        }
    }
}
