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
 * @name ORM
 * @file /src/Infrastructure/Base/ORM
 * @observations example ORM domain entity
 *
 */


namespace Src\Infrastructure\Base\ORM;


use Illuminate\Database\Eloquent\Model;
use Src\Domain\Base\BaseException;
use Src\Infrastructure\Base\ORM\Eloquent\Eloquent;
use Src\Infrastructure\Base\ORM\Eloquent\EloquentDb;

class ORM
{
    private $DataOrm = []; //list db orm

    /**
     * @var Model|EloquentDb|Eloquent change for class
    */
    private $db = null; //type DB

    /**
     * ORM constructor.
     * @param string $name
     * @throws BaseException
     */
    public function __construct(string $name = "eloquent")
    {
        $this->DataOrm = [
            "eloquent" => new Eloquent(),
        ];
        if(!empty($name)){
            $this->db = $this->DataOrm[$name];
        }
    }

    /**
     * @return Model|mixed|Eloquent|EloquentDb
     */
    public function getDb(){
        return $this->db;
    }

    /**
     * @param string $name
     */
    public function setDb(string $name){
        $this->db = $this->DataOrm[$name];
    }


}
