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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Src\Domain\Base\IEntity;
use Src\Domain\Base\IRepository;


class GenericRepository implements IRepository
{
    /**
     * @var IEntity
    */
    private $entity;
    private $table;

    /**
     * @var IDbContext
    */
    protected $_db;

    protected function __construct(IDbContext $context, string $entity)
    {
        $this->_db = $context->DbSet($entity);
        $this->_db->setEntity($entity);
        $this->table = $entity;
    }

    /**
     * @param int $id
     * @return IEntity
     */
    public function find(int $id): IEntity
    {
        //select *from entity where id = $id
        return $this->_db->find($id);
    }

    /**
     * @param array $entity
     * @return IEntity
     */
    public function findBy(array $entity): IEntity
    {
        //select *from entity where key = key
        return $this->_db->where($entity);
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        //select *from entity
        return $this->_db->all();
    }


    /**
     * @param IEntity $entity
     * @return IEntity
     */
    public function add(IEntity $entity): IEntity
    {
        //insert into entity(?,?) values(?,?)
        $this->entity = $entity;
        return $this->usingRepository(1);
    }

    /**
     * @param array $entity
     * @return bool
     */
    public function addRange(array $entity): bool
    {
        //insert into entity(?,?) values(?,?),(?,?)
        $this->entity = $entity;
        return $this->usingRepository(2);
    }

    /**
     * @param IEntity $entity
     * @return bool
     */
    public function edit(IEntity $entity): bool
    {
        //update entity set key = key
        $this->entity = $entity;
        return $this->usingRepository(3);

    }

    /**
     * @param IEntity $entity
     * @return bool
     */
    public function del(IEntity $entity): bool
    {
        $this->entity = $this->find($entity->getId());
        return $this->usingRepository(4);
    }

    /**
     * @param array $entity
     * @return bool
     */
    public function deleteRange(array $entity): bool
    {
        $this->entity = array_map(function($item){ return $item[0]; }, $entity);
        return $this->usingRepository(5);

    }

    /**
     * @return bool
     */


    public function SaveChanges() : bool {
        if(!$this->entity){
            $this->_db->startRollback($this->table);
            return false;
        }
        $this->_db->startCommit($this->table);
        return true;
    }

    private function usingRepository(int $type =0){
        try{
            switch ($type){
                case 1:{ //many insert
                    return $this->_db->create($this->entity);
                }
                case 2:{ //multi insert
                    return $this->_db->DB($this->table)->insert((array)$this->entity);
                }
                case 3:{ //update
                    return $this->entity->where(["id"=>$this->entity->getId()])->update((array)$this->entity);
                }
                case 4:{ //delete
                    return $this->entity->delete();
                }
                case 5:{ //multiple delete
                    return $this->_db->DB($this->table)->whereIn('id', $this->entity)->delete();
                }
                default:{
                    Log::warning("option no exits");
                    $this->_db->startRollback($this->table);
                }
            }
        }catch (ValidationException $exception){
            $this->_db->startRollback($this->table);
        }catch (\Exception $e){
            $this->_db->startRollback($this->table);
        }finally{
            $this->_db->startRollback($this->table);
            return false;
        }
    }

    public function __invoke()
    {
        DB::beginTransaction();
        Log::info("start Transaction in .$this->table.");
    }
    public function __destruct()
    {
        unset($this);
        Log::info("destruct entity in .$this->table.");
    }




}
