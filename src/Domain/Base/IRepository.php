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
 * @name IRepository
 * @file /src/Domain/Base/IRepository.ph
 * @observations example IRepository domain entity
 *
 */

namespace Src\Domain\Base;


interface IRepository
{

    /**
     * @param int $id
     * @return Entity
     */
    public function find(int $id) : IEntity;

    /**
     * @param array $entity
     * @return Entity
     */
    public function findBy(array $entity) : IEntity;

    /**
     * @return array
     */
    public function getAll() : array;

    /**
     * @param Entity $entity
     * @return Entity
     */
    public function add(IEntity $entity) : IEntity;

    /**
     * @param array $entity
     * @return array
     */
    public function addRange(array $entity) : bool;

    /**
     * @param IEntity $entity
     * @return bool
     */
    public function edit(IEntity $entity) : bool;

    /**
     * @param IEntity $entity
     * @return bool
     */
    public function del(IEntity $entity) : bool;

    /**
     * @param array $entity
     * @return bool
     */
    public function deleteRange(array $entity) : bool;



}
