<?php

namespace App\Http\Responses\Ecommerce;

use Illuminate\Http\JsonResponse;

class InvSyncResponse
{
    /**
     * Return a standardized success response.
     */
    public static function success(array \ = [], string \ = 'Success', int \ = 200): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => \,
            'data' => \,
        ], \);
    }

    /**
     * Return a standardized error response.
     */
    public static function error(string \ = 'Error', int \ = 400, array \ = []): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => \,
            'errors' => \,
        ], \);
    }
}
