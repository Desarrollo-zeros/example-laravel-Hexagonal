<?php

namespace Src\Application\Abstracts;

use JsonSerializable;

interface IServiceResponse
{
    /**
     * @param string       $message
     * @param array|object $entity
     * @return array
     */
    public function responseSuccess(string $message, $entity);

    /**
     * @param array|object $error
     * @return array
     */
    public function responseError($error);
}
