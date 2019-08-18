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
 * @name DbContextBase
 * @file /src/Infrastructure/base/DbContextBase.php
 * @observations example DbContextBase domain entity
 *
 */

namespace src\Infrastructure\Base;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use src\Domain\Base\IEntity;


class DbContextBase implements IDbContext
{

    /**
     * @param string $entity
     * @return Model
     */
    public function DbSet(string $entity): Model
    {
        return null;
    }

    /**
     * @param string $entity
     * @return mixed|void
     */
    public function DB(string $entity)
    {
        return DB::table($entity);
    }

    /**
     * @param string $entity
     * @throws BaseException
     */
    public function startRollback(string $entity): void
    {
        DB::rollBack();
        Log::warning("Error in Transaction, start rollBack in entity .$entity.");
        throw new BaseException($entity,"Error in Transaction, start rollBack in entity .$entity.");
    }

    /**
     * @param string $entity
     */
    public function startCommit(string $entity): void
    {
        DB::commit();
        Log::info("start commit in entity.$entity.");
    }


    /**
     * @param IEntity $entity
     * @return int
     */
    public function SaveChanges(IEntity $entity): int
    {
        $this->startCommit("entity");
        return 1;
    }

    public function setEntity(string $entity): void
    {
        // TODO: Implement setEntity() method.
    }

    public function getEntity(): string
    {
        // TODO: Implement getEntity() method.
    }
}






