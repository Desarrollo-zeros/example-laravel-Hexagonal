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
use Src\Domain\Base\BaseException;
use Src\Domain\Entity\UserEntity\UserEntity;
use Src\Infrastructure\Abstracts\IDBBaseContext;
use Src\Infrastructure\Base\ORM\Eloquent;
use Src\Infrastructure\Base\ORM\ORM;


class DbContextBase extends ORM implements IDBBaseContext
{
    protected $db;
    public $dataEntity = null;

    /**
     * DbContextBase constructor.
     * @param string $name
     * @throws BaseException
     */
    public function __construct(string $name = "eloquent")
    {
        parent::__construct($name);
        $this->db = $this->getDb();
    }


    /**
     * @param string $entity
     * @return Eloquent\Eloquent
     */
    public function DbSet(string $entity)
    {
        return $this->db->DbSet($entity,$this->getDataEntity());

    }

    /**
     * @return array|null
     */
    public function getDataEntity()
    {
        return[
            UserEntity::class => [
                "entity" => "user",
                "fillable" => ["id","username","password","email"],
                "timestamps" => false
        ],];
    }

    /**
     * @param $dataEntity
     */
    public function setDataEntity($dataEntity)
    {
        $this->dataEntity = $dataEntity;
    }
}






