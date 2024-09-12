<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait HttpBackendResponses
{
    protected function success(string $title = "", string $message = ""): JsonResponse
    {
        $title = $title ?: __('label.notification.success');
        $message = $message ?: __('label.notification.success');
        return response()->json([
            'status' => 'success',
            'title' => $title,
            'message' => $message
        ]);
    }

    protected function error(string $title = "", string $message = ""): JsonResponse
    {
        $title = $title ?: __('label.error');
        $message = $message ?: trans('label.something_went_wrong');
        return response()->json([
            'status' => 'error',
            'title' => $title,
            'message' => $message
        ]);
    }
}
