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
 * @file /src/Infrastructure/Abstracts/IDbContext.php
 * @observations example IDbContext domain entity
 *
 */

namespace Src\Infrastructure\Abstracts;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use phpDocumentor\Reflection\Types\This;
use Src\Domain\Abstracts\IEntity;
use Src\Infrastructure\Base\ORM\Eloquent;
use Src\Infrastructure\Base\ORM\ORM;


interface IDbContext
{


    public function getEntity();


    /**
     * @param string $entity
     * @param array $dataEntity
     * @return ORM|Eloquent
     */
    public function DbSet(string $entity, $dataEntity = []);

    /**
     * @param string $entity
     * @return Builder
     */
    public function DB(string $entity);

    /**
     * @param IEntity|object $entity
     * @return int
     */
    public function SaveChanges(object $entity) : int;


    public function startTransaction() : void;

    /**
     * @param string $entity
     */
    public function startCommit(string $entity) : void;

    /**
     * @param string $entity
     */
    public function startRollback(string $entity) : void;


    /**
     * @param int $id
     * @return IDbContext
     */
    public function find(int $id) : self;



    /**
     * @param array $where
     * @return IDbContext
     */
    public function where(array $where = []) : self;

    /**
     * @param string $column
     * @param string $direction
     * @return IDbContext
     */
    public function orderBy(string $column = "id", string $direction = "asc") : self;

    /**
     * @param int $count
     * @return IDbContext
     */
    public function take(int $count) : self;

    /**
     * @param array $column
     * @return object
     */
    public function get(array $column = []) : object;

    /**
     * @param array $column
     * @return IDbContext
     */
    public function getAll(array $column = []) : self;

    /**
     * @param array $entity
     * @return IDbContext
     */
    public function add(array $entity) : self;

    /**
     * @param array $entities
     * @return bool
     */
    public function addRange(array $entities) : bool;

    /**
     * @param array|null $entity
     * @param string $column
     * @return bool
     */
    public function deleteRange(array $entity = null, string $column = "id") : bool;

    /**
     * @param object|null $entity
     * @return bool
     */
    public function del(object $entity = null) : bool ;

    /**
     * @param object|null $entity
     * @return bool
     */
    public function edit(object $entity = null) : bool;

    /**
     * @param array $whereIn
     * @param string $column
     * @return IDbContext
     */
    public function whereIn(array $whereIn = [], string $column = "id") : self;
}
