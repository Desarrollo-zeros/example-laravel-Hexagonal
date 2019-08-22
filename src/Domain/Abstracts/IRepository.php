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
 * @file /src/Domain/Abstracts/IRepository.ph
 * @observations example IRepository domain entity
 *
 */

namespace Src\Domain\Abstracts;


use PhpOption\Tests\Repository;
use Src\Domain\Base\Entity;

interface IRepository
{
    /**
     * @param array $column
     * @return
     */
    public function get(array $column =["*"]);

    /**
     * @param int $id
     * @return Entity|object
     */
    public function find(int $id);

    /**
     * @param array $where
     * @return $this|Repository
     */
    public function findBy($where = []);

    /**
     * @param array  $columns
     * @param string $column
     * @param string $direction
     * @param int    $take
     * @return array
     */
    public function getAll($columns = ["*"],$column = "id", $direction = "asc", $take = 100) : array ;

    /**
     * @param object|IEntity|array $entity
     * @return Entity|object
     */
    public function add(object $entity) : object ;


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
     * @param array $entity
     * @param string $column
     * @return bool
     */
    public function deleteRange(array $entity,string $column = "id") : bool;

    /**
     * @param array $data
     * @return array
     */
    public function toObject(array $data = []);

    /**
     * @param array $data
     * @return mixed
     */
    public function firstObject(array $data = []) : object;

    /**
     * @param array $data
     * @return object
     */
    public function lastObject(array $data = []) : object;
}
