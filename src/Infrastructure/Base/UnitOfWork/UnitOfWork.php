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

namespace Src\Infrastructure\Base\UnitOfWork;


use Src\Domain\Abstracts\IUnitOfWork;
use Src\Domain\Base\BaseException;
use Src\Domain\Abstracts\IEntity;
use Src\Infrastructure\DBContext;

class UnitOfWork implements IUnitOfWork
{

    private $dbContext;
    private $entity = null;

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
     */
    public function commit(): int
    {
        return $this->dbContext->getDb()->SaveChanges($this->getEntity());
    }

    /**
     * @throws BaseException
     */
    public function rollback(): void
    {
        $this->dbContext->getDb()->startRollback("entity");
    }
    /**
     * @param IEntity|object $entity
     */
    public function setEntity(object $entity = null) : void{ //opcional use
        $this->entity = $entity;
    }
    /**
     * @return IEntity|object
     */
    public function getEntity() : object { //opcional use
        return (object)$this->entity;
    }
}
