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

namespace Src\Infrastructure;

use Illuminate\Database\Eloquent\Model;
use Src\Domain\Base\BaseException;
use Src\Domain\Entity\UserEntity\UserEntity;
use Src\Infrastructure\Base\DbContextBase;


class DBContext extends DbContextBase
{
    /**
     * @var Model
    */
    protected $db;
    private $entity;


    /**
     * DBContext constructor.
     * @throws BaseException
     */
    public function __construct()
    {

        $this->db = new ORM();
        parent::__construct($this->db);
    }

    /**
     * @param string $entity
     * @return Model
     */
    public function DbSet(string $entity): Model
    {
        //add entity
        $dataEntity = [
            UserEntity::class => [
                "entity" => "user",
                "fillable" => ["username","password","email"],
                "timestamps" => false
            ],
        ];


        $this->db->fillable = $dataEntity[$entity]["fillable"];
        $this->db->timestamps = $dataEntity[$entity]["timestamps"];
        $this->db->setTable($dataEntity[$entity]["entity"]);
        return $this->db;
    }
}

