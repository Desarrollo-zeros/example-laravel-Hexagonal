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
 * @name IUnitOfWork
 * @file /src/Domain/Abstracts/IUnitOfWork.php
 * @observations example IUnitOfWork domain entity
 *
 */

namespace Src\Domain\Abstracts;


use Src\Domain\Base\IEntity;

interface IUnitOfWork
{
    /**
     * @return int 1 save commit, 0 fail commit
     */
    public function commit() : int;

    /**
     *
     */
    public function rollback() : void;

    /**
     * @param object|IEntity $entity
     */
    public function setEntity(object $entity) : void ;

    /**
     * @return object|IEntity
     */
    public function getEntity() : object ;
}
