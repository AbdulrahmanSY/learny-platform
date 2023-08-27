<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Service\Attribute\Required;

trait ApiResponderTrait
{
    public function success($data = [], $message = null, $statusCode = Response::HTTP_OK): JsonResponse
    {
        if (!$message) {
            $message = Response::$statusTexts[$statusCode];
        }
        $info = [
            'message' => $message,
            'data' => $data,
        ];
//        if ($info['data'] == null) {
//            unset($info['data']);
//        }
        return response()->json($info, $statusCode);
    }

    public function error($message = null, $errors = null, $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        if (!$message) {
            $message = Response::$statusTexts[$statusCode];
        }
        if (!is_array($errors)){
            $errors = [$errors];
        }
        return response()->json([
            'message' => $message,
            'errors' => $errors
        ], $statusCode);
    }


    public function unauthorizedResponse($message = '', $errors = null): JsonResponse
    {
        return $this->error($message, $errors, Response::HTTP_UNAUTHORIZED);
    }

    public function forbiddenResponse($message = '', $errors = null): JsonResponse
    {
        return $this->error($message, $errors, Response::HTTP_FORBIDDEN);
    }

    public function badRequestResponse($message = null, $errors = null): JsonResponse
    {
        return $this->error($message, $errors, Response::HTTP_BAD_REQUEST);
    }

    public function notFoundResponse($message = null, $errors = null): JsonResponse
    {
        return $this->error($message, $errors, Response::HTTP_NOT_FOUND);
    }

    public function createdResponse($data = null, $message = ''): JsonResponse
    {
        return $this->success($data, $message, Response::HTTP_CREATED);
    }

    public function okResponse($data = null, $message = ''): JsonResponse
    {
        return $this->success($data, $message);
    }

    public function noContent($message = ''): JsonResponse
    {
        return $this->success(null, $message, Response::HTTP_OK);
    }


}
