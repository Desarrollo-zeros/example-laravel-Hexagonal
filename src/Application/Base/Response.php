<?php

namespace Src\Application\Base;

use Src\Domain\Abstracts\IEntity;

class Response
{
    /**
     * @var int
    */
    private $statusCode;

    /**
     * @var string
    */
    private $status;

    /**
     * @var string
     */
    private $message;

    /**
     * @var IEntity|array|object $entity
    */
    private $entity;

    /**
     * Response constructor.
     * @param int     $statusCode
     * @param string  $status
     * @param string  $message
     * @param IEntity|array|object $entity
     */
    public function __construct(int $statusCode, string $status, string $message, $entity)
    {
        $this->statusCode = $statusCode;
        $this->status = $status;
        $this->message = $message;
        $this->entity = $entity;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode): void
    {
        $this->status_code = $statusCode;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return IEntity
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @param IEntity $entity
     */
    public function setEntity(IEntity $entity): void
    {
        $this->entity = $entity;
    }

}
