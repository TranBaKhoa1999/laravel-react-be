<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\OllamaService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AssistantController extends Controller
{
    protected $ollamaService;

    public function __construct(OllamaService $ollamaService)
    {
        $this->ollamaService = $ollamaService;
    }

    public function getResponse(Request $request): JsonResponse
    {
        $request->validate([
            'prompt' => 'required|string',
        ]);

        try {
            $response = $this->ollamaService->getAssistantResponse(
                $request->prompt

            );
            return printJson($response, buildStatusObject('HTTP_OK'), $this->lang);
        } catch (\Exception $e) {
            return printJson($e->getMessage(), buildStatusObject('HTTP_INTERNAL_SERVER_ERROR'), $this->lang);
        }
    }
}
