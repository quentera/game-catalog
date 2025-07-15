<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponse
{
    protected function success($data = [], string $message = 'Success', int $code = 200, array $extras = []): JsonResponse
    {
        return response()->json([
            'status'  => $code,
            'success' => true,
            'message' => $message,
            'payload' => $this->formatPayload($data, null, $extras),
        ], $code);
    }

    protected function error(string $message = 'Something went wrong', int $code = 400, array $errors = []): JsonResponse
    {
        return response()->json([
            'status'  => $code,
            'success' => false,
            'message' => $message,
            'errors'  => $errors,
        ], $code);
    }

    protected function paginate(LengthAwarePaginator $paginatedData, $resourceCollection, string $message = 'Success', array $extras = []): JsonResponse
    {
        return response()->json([
            'status'  => 200,
            'success' => true,
            'message' => $message,
            'payload' => $this->formatPayload($resourceCollection, $paginatedData, $extras),
        ]);
    }

    private function formatPayload($data, ?LengthAwarePaginator $paginatedData = null, array $extras = []): array
    {
        if ($paginatedData) {
            return $this->formatPaginatedPayload($data, $paginatedData, $extras);
        }

        return $data;
    }

    private function formatPaginatedPayload($data, LengthAwarePaginator $paginatedData, array $extras): array
    {
        return [
            'count'         => $paginatedData->total(),
            'total_pages'   => $paginatedData->lastPage(),
            'current_page'  => $paginatedData->currentPage(),
            'limit'         => $paginatedData->perPage(),
            'next'          => $paginatedData->nextPageUrl(),
            'previous'      => $paginatedData->previousPageUrl(),
            'results'       => $data,
            'extras'        => $extras,
        ];
    }
}
