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
     * @return Entity|object
     */
    public function find(int $id);

    /**
     * @param array $where
     * @param string $column
     * @param string $direction
     * @param int $take
     * @param array $get
     * @return Entity|object
     */
    public function findBy($where = ["id"=>1], $column = "id", $direction = "asc", $take = 100, $get = ["*"]) : object;

    /**
     * @param string $column
     * @param string $direction
     * @param int $take
     * @param array $get
     * @return object
     */
    public function getAll($column = "id", $direction = "asc", $take = 100, $get = ["*"]) : object ;

    /**
     * @param object|IEntity|array $entity
     * @return Entity|object
     */
    public function add(object $entity) ;


    /**
     * @param array $entity
     * @return bool
     */
    public function addRange(array $entity) : bool;

    /**
     * @param IEntity|object $entity
     * @return int
     */
    public function edit(object $entity) : int;

    /**
     * @param IEntity|object $entity
     * @return bool
     */
    public function del(object $entity) : bool;

    /**
     * @param object $entity
     * @return bool
     */
    public function deleteRange(object $entity) : bool;
    public function toObject();
    public function firstObject();

}
