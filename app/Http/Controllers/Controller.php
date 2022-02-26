<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected const DEFAULT_PAGINATION_LIMIT = 10;
    protected const MAX_PAGINATION_LIMIT = 100;
    protected const DEFAULT_PAGINATION_LIMIT_NAME = 'limit';

    protected function response(JsonResource $resource): JsonResponse
    {
        $response = $resource->response();
        $response_content = json_decode($response->getContent(), true);

        // metadata
        $content = [
            'metadata' => [
                'code' => $response->getStatusCode(),
                'message' => Response::$statusTexts[$response->getStatusCode()],
            ],
        ];

        //data
        $content['data'] = $response_content['data'];

        // pagination
        if (array_key_exists('links', $response_content)) {
            $content['links'] = $response_content['links'];
        }

        if (array_key_exists('meta', $response_content)) {
            $meta = $response_content['meta'];

            //in order to prevent large responses, "links" property inside meta is removed
            unset($meta['links']);

            $content['pagination'] = $meta;
        }

        $response->setContent(json_encode($content));

        return $response;
    }

    protected function getPaginationLimit(Request $request): int
    {
        $limit = (int)$request->input(
            self::DEFAULT_PAGINATION_LIMIT_NAME,
            self::DEFAULT_PAGINATION_LIMIT
        );
        $limit = $limit > self::MAX_PAGINATION_LIMIT ? self::MAX_PAGINATION_LIMIT : $limit;

        return $limit;
    }
}
