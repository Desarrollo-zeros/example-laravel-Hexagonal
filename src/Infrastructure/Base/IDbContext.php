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
 * @name IDbContext
 * @file /src/Infrastructure/base/IDbContext.php
 * @observations example IDbContext domain entity
 *
 */

namespace Src\Infrastructure\Base;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use src\Domain\Base\IEntity;

interface IDbContext
{
    /**
     * @param string $entity
     * @return Model
     */
    public function DbSet(string $entity) : Model;

    /**
     * @param string $entity
     * @return Builder
     */
    public function DB(string $entity);

    /**
     * @param IEntity $entity
     * @return int
     */
    public function SaveChanges(IEntity $entity) : int;

    /**
     * @param string $entity
     */
    public function startCommit(string $entity) : void;

    /**
     * @param string $entity
     */
    public function startRollback(string $entity) : void;

    public function setEntity(string $entity) : void ;

    public function getEntity() : string;


}
