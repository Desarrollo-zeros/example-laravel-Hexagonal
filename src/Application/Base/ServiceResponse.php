<?php

namespace Src\Application\Base;

use JsonSerializable;
use Src\Application\Abstracts\IServiceResponse;
use Src\Domain\Abstracts\IEntity;

class ServiceResponse implements IServiceResponse
{
    /**
     * @param string              $message
     * @param array|object|string|IEntity $entity
     * @return Response
     */
    public function responseSuccess(string $message, $entity)
    {
        http_response_code(200);
        return new Response(200, "success", $message, $entity);
    }

    /**
     * @param array|object|string $error
     * @return object
     */
    public function responseError($error)
    {
        http_response_code(500);
        return new Response(200, "success", $error, null);
    }
}
