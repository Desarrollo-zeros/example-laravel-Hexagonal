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


use Src\Domain\Base\BaseException;
use Src\Infrastructure\Base\DbContextBase;

class DBContext extends DbContextBase
{

    /**
     * DBContext constructor.
     * @param string name
     * @throws BaseException
     */
    public function __construct(string $name = "eloquent")
    {
        parent::__construct($name);
    }

    public function setDataEntity($dataEntity){
        parent::setDataEntity($dataEntity);
    }

    public function getDataEntity(){
        if($this->dataEntity){
            return $this->dataEntity;
        }
        return parent::getDataEntity();
    }

    /**
     * @param string $entity
     * @return Base\ORM\Eloquent\Eloquent
     */
    public function DbSet(string $entity){ //forLaravel
       return parent::DbSet($entity);
    }
}

