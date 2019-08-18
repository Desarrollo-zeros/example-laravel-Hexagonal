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
 * @name DBContext
 * @file /src/Infrastructure/DBContext.php
 * @observations example DBContext domain entity
 *
 */

namespace src\Infrastructure;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use src\Domain\Base\IEntity;
use src\Infrastructure\Base\BaseException;
use src\Infrastructure\Base\DbContextBase;


class DBContext extends DbContextBase
{
    /**
     * @var Model
    */
    protected $db;
    private $entity;

    /**
     * DBContext constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->db = $model;
    }

    /**
     * @param string $entity
     * @return Model
     */
    public function DbSet(string $entity): Model
    {
        $this->db->setTable($entity);
        return $this->db;
    }

    /**
     * @param string $entity
     * @return Builder
     */
    public function DB(string $entity){
        return DB::table($entity);
    }

    /**
     * @param string $entity
     */
    public function setEntity(string $entity) : void{
        $this->entity = $entity;
    }

    /**
     * @return string
     */
    public function getEntity() :string {
        return $this->entity;
    }


    /**
     * @param IEntity $entity
     * @return int
     * @throws BaseException
     */
    public function SaveChanges(IEntity $entity): int
    {
        if(!$entity) {$this->startRollback($this->getEntity()); return 0;}
        return 1;
    }
}

