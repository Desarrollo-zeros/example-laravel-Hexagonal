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
 * @name GenericRepository
 * @file /src/Infrastructure/base/GenericRepository.php
 * @observations example GenericRepository domain entity
 *
 */

namespace Src\Infrastructure\Base\Repository;

use Src\Domain\Base\BaseException;
use Src\Domain\Base\BuilderFactory;
use Src\Domain\Abstracts\IEntity;
use Src\Domain\Abstracts\IRepository;
use Src\Domain\Entity\UserEntity\UserEntity;
use Src\Infrastructure\Abstracts\IDBBaseContext;
use Src\Infrastructure\Abstracts\IDbContext;


class GenericRepository implements IRepository
{
    /**
     * @var IEntity
     */
    public $entity;
    private $table;

    /**
     * Ok
     * @var IDbContext
     */
    protected $_db;

    public function __construct(IDBBaseContext $context, string $entity = UserEntity::class)
    {
        $this->_db = $context->DbSet($entity);
        $this->table = $entity;
    }

    /**
     * Ok
     * @param int $id
     * @return object|UserEntity
     * @throws BaseException
     */
    public function find(int $id)
    {
        //select *from entity where id = $id
        $entity = $this->_db->find($id);
        if(!$entity){
            throw new BaseException($this->table,"entity no exits");
        }
        return BuilderFactory::Builder($this->table,$entity->getEntity());
    }



    public function findBy($where = [])
    {
        $this->entity = $this->_db->where($where);
        return $this;
    }

    public function get(array $column = ["*"])
    {
        $this->entity= $this->entity->get($column);
        return $this;
    }

    /**
     * @return array|mixed|object|IEntity|null
     * @throws BaseException
     */
    public function toObject(){
        if(is_array($this->entity->toArray())){
            $entityData = [];
            foreach ($this->entity->toArray() as $row){
                if($row)
                    array_push($entityData,BuilderFactory::Builder($this->table,$row));
            }
            if(!$entityData)return null;
            $this->entity = $entityData;
        }else{
            $this->entity = BuilderFactory::Builder($this->table,$this->entity->toArray());
        }

        return $this->entity;
    }

    /**
     * @return BuilderFactory
     * @throws BaseException
     */
    public function firstObject() : object {
        return  BuilderFactory::Builder($this->table,$this->entity[0]);
    }

    public function lastObject() : object{
        return  BuilderFactory::Builder($this->table,$this->entity[count($this->entity)-1]);
    }


    /**
     * @param string $column
     * @param string $direction
     * @param int $take
     * @param array $columns
     * @return $this
     */
    public function getAll($columns = ["*"],$column = "id", $direction = "asc", $take = 100): object
    {
        $this->entity = $this->_db->where()->orderBy($column,$direction)->take($take)->get($columns);
        return $this;
    }


    /**
     * @param object $entity
     * @return GenericRepository
     * @throws BaseException
     */
    public function add(object $entity) : object
    {
        //insert into entity(?,?) values(?,?)
        $this->entity = $entity;
        $entity = $this->_db->add($entity->toArray());
        $this->entity = BuilderFactory::Builder($this->table,$entity->getEntity());
        return $this;
    }


    /**
     * Ok
     * @param array $entity
     * @return bool
     * @throws BaseException
     */
    public function addRange(array $entity): bool
    {
        return $this->_db->addRange($entity);;
    }


    /**
     * Ok
     * @param IEntity|object|BuilderFactory $entity
     * @return int
     * @throws BaseException
     */
    public function edit(object $entity) : int
    {
        if($entity->getId() == 0){
          throw new BaseException($this->table,"entity no exits");
        }
        $this->entity = $entity;
        return $this->_db->edit($entity);
    }

    /**
     * Ok
     * @param IEntity|object $entity
     * @return bool
     * @throws BaseException
     */
    public function del(object $entity = null): bool
    {

        if(empty($entity->getId())){
            throw new BaseException($this->table,"entity no exits");
        }
        $this->entity = $entity;
        return $this->_db->del($entity) > 0;
    }

    /**
     * Ok
     * @param array $entity
     * @param string $column
     * @return bool
     * @throws BaseException
     */
    public function deleteRange(array $entity =null, string $column = "id"): bool
    {
        return $this->_db->deleteRange($entity);
    }


    public function __destruct()
    {
    }

}
