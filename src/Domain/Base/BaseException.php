<?php

/**
 * Example-laravel-Hexagonal has static methods for inflecting text.
 *
 * example DDD architecture
 * use of hexagonal programming
 *
 * Hexagonal Architecture that allows us to develop and test our application in isolation from the framework,
 * the database, third-party packages and all those elements that are around our application
 *
 * @link https://github.com/Desarrollo-zeros/example-laravel-Hexagonal
 * @since  1.0
 * @author dev zeros  <wowzeros2@gmail.com>
 * @name BaseException
 * @file /src/Domain/Base/BaseException.php
 * @observations example BaseException domain entity
 *
 */

namespace Src\Domain\Base;

use Src\Domain\Abstracts\IException;

class BaseException extends \Exception implements IException
{


    public function __construct(string $entity = null,string $message = null)
    {
        parent::__construct((string)json_encode($this->message($entity,true,$message)));
    }

    public function message(string $entity, bool $status, string $message)
    {
        return [
            "Entity" => $entity,
            "status" => $status,
            "message" => $message
        ];
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
