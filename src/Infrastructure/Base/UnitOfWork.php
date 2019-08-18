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
 * @name UnitOfWork
 * @file /src/Infrastructure/base/UnitOfWork.php
 * @observations example UnitOfWork domain entity
 *
 */

namespace Src\Infrastructure\Base;


use Src\Domain\Abstracts\IUnitOfWork;
use Src\Domain\Base\IEntity;
use Src\Infrastructure\DBContext;

class UnitOfWork implements IUnitOfWork
{

    private $dbContext;
    private $entity;

    /**
     * UnitOfWork constructor.
     * @param DBContext $dbContext
     */
    public function __construct(DBContext $dbContext)
    {
        $this->dbContext = $dbContext;
    }


    /**
     * @return int
     * @throws BaseException
     */
    public function commit(): int
    {
        return $this->dbContext->SaveChanges($this->getEntity());
    }

    /**
     * @throws BaseException
     */
    public function rollback(): void
    {
        $this->dbContext->startRollback("entity");
    }
    /**
     * @param IEntity $entity
     */
    public function setEntity(IEntity $entity) : void{
        $this->entity = $entity;
    }
    /**
     * @return IEntity
     */
    public function getEntity() : IEntity {
        return $this->entity;
    }
}
