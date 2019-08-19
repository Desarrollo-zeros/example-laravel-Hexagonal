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

namespace Src\Infrastructure\Base;


use Dotenv\Exception\ValidationException;
use Illuminate\Database\Query\Builder;
use Src\Domain\Base\BaseException;
use Src\Domain\Base\BuilderFactory;
use Src\Domain\Base\IEntity;
use Src\Domain\Base\IRepository;
use Src\Domain\Entity\UserEntity\UserEntity;



class GenericRepository implements IRepository
{
    /**
     * @var IEntity|object|array
     */
    public $entity;
    private $table;

    /**
     * Ok
     * @var IDbContext
     */
    protected $_db;

    public function __construct(IDbContext $context, string $entity = "tableName")
    {
        $this->_db = $context->DbSet($entity);
        $this->table = $entity;
    }

    /**
     * Ok
     * @param int $id
     * @return GenericRepository ok
     * @throws BaseException
     */
    public function find(int $id)
    {
        //select *from entity where id = $id
        $data = $this->_db->find($id);
        if(!isset($data)){
            throw new BaseException($this->table,"entity no exits");
        }
        $this->entity = BuilderFactory::Builder($this->table,$data);
        return $this;
    }


    /**
     * Ok
     * @param array $where
     * @param string $column
     * @param string $direction
     * @param int $take
     * @param array $get
     * @return Builder|object|array|IEntity|GenericRepository
     * @throws BaseException
     */
    public function findBy($where = ["id"=>1], $column = "id", $direction = "asc", $take = 100, $get = ["*"]): object
    {
        //select *from entity where key = key
        $this->entity = $this->_db->where($where)->orderBy($column,$direction)->take($take)->get($get);
        if(count($this->entity) < 1){
            throw new BaseException($this->table,"entity no exits");
        }
        return $this;
    }


    /**
     * Ok
     * @return array|object|IEntity|BuilderFactory
     * @throws BaseException
     */
    public function toObject(){
        $entityData = [];
        foreach ($this->entity as $row){
            if($row)
                array_push($entityData,BuilderFactory::Builder($this->table,$row));
        }
        if(!$entityData)return null;
        $this->entity = $entityData;
        return $this->entity;
    }

    /**
     * @return BuilderFactory
     * @throws BaseException
     */
    public function firstObject() : object {
        return  BuilderFactory::Builder($this->table,$this->entity[0]);
    }


    /**
     * Ok
     * @param string $column
     * @param string $direction
     * @param int $take
     * @param array $get
     * @return GenericRepository
     */
    public function getAll($column = "id", $direction = "asc", $take = 100, $get = ["*"]): object
    {
        //select *from entity
        $this->entity = $this->_db->orderBy($column,$direction)->take($take)->get($get)->all();
        return $this;
    }


    /**
     * Ok
     * @param IEntity|object|array $entity
     *
     * @return array|bool|int|object|IEntity|null
     * @throws BaseException
     */
    public function add(object $entity)
    {
        //insert into entity(?,?) values(?,?)
        $this->entity = $entity;
        $this->entity->setId($this->execute(1)->id);
        return $this->entity;
    }


    /**
     * Ok
     * @param array $entity
     * @return bool
     * @throws BaseException
     */
    public function addRange(array $entity): bool
    {
        $this->entity = $entity;
        return $this->execute(2);
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
        if($this->execute(3) == 0){
            throw new BaseException($this->table,"entity is equals no modified");
        }
        return 1;
    }

    /**
     * Ok
     * @param IEntity|object $entity
     * @return bool
     * @throws BaseException
     */
    public function del(object $entity): bool
    {
        if($entity->getId() == 0){
            throw new BaseException($this->table,"entity no exits");
        }
        $this->entity = $entity;
        return $this->execute(4);
    }

    /**
     * Ok
     * @param object $entity
     * @return bool
     * @throws BaseException
     */
    public function deleteRange(object $entity): bool
    {
        $data = [];
        foreach ($entity as $row){
            array_push($data,BuilderFactory::Builder(UserEntity::class,$row->toArray())->toArray());
        }
        $this->entity = array_map(function($item){ return $item["id"]; }, $data);
        return $this->execute(5) > 0;
    }


    /**
     * @param int $type
     * @return bool|int|IEntity|object
     * @throws BaseException
     */
    private function execute(int $type =0){
        try{
            switch ($type){
                case 1:{ //many insert
                    $entity = $this->_db->fill($this->entity->toArray());
                    $entity->save();
                    return $entity;
                }
                case 2:{ //multiple insert
                   return $this->_db->DB($this->_db->getTable())->insert($this->entity);
                }
                case 3:{
                    return $this->_db
                        ->where(["id"=>$this->entity->getId()])
                        ->update($this->entity->toArray());
                }
                case 4:{
                    return $this->_db
                        ->where(["id"=>$this->entity->getId()])
                        ->delete();
                }
                case 5:{
                    return $this->_db->whereIn('id', $this->entity)->delete();
                }
                default:{
                    $this->_db->startRollback($this->table);
                }
            }
        }catch (ValidationException $exception){
            $this->_db->startRollback($this->table);
            throw new BaseException($this->table,$exception->getMessage());
        } catch (\PDOException $exception){
            $this->_db->startRollback($this->table);
            throw new BaseException($this->table,$exception->getMessage());
        } catch (\Exception $exception){
            $this->_db->startRollback($this->table);
            throw new BaseException($this->table,$exception->getMessage());
        }
        return $this;
    }



    public function __destruct()
    {
    }

}
