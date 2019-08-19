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

namespace Src\Infrastructure\Base;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Src\Domain\Base\BaseException;
use Src\Domain\Base\IEntity;
use Src\Infrastructure\ORM;


class DbContextBase extends ORM
{

    protected $db;

    /**
     * DbContextBase constructor.
     * @param ORM $orm
     * @throws BaseException
     */
    public function __construct(ORM $orm)
    {
        DB::beginTransaction();
        parent::__construct($orm->getTable());
        $this->db = $orm;

    }

    /**
     * @param string $entity
     * @return Model
     */
    public function DbSet(string $entity): Model
    {
        //exits db user table
        $this->db->setTable("user"); //default
        return $this->db;
    }

    /**
     * @param string $entity
     * @return Builder
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
        parent::startRollback($entity);
        throw new BaseException($entity,"Error in Transaction, start rollBack in entity .$entity.");
    }

    /**
     * @param string $entity
     */
    public function startCommit(string $entity): void
    {
        parent::startCommit($entity);
    }


    /**
     * @param IEntity|object $entity
     * @return int
     */
    public function SaveChanges(object $entity = null): int
    {
        if(!$entity){
            $this->db->startRollback($this->table);
            return 0;
        }
        $this->db->startCommit($this->table);
        return 1;
    }
}






