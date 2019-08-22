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
 * @name Eloquent
 * @file /src/Infrastructure/Base/ORM
 * @observations example Eloquent domain entity
 *
 */

namespace Src\Infrastructure\Base\ORM\Eloquent;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use PDOException;
use Src\Domain\Base\BaseException;
use Src\Domain\Abstracts\IEntity;
use Src\Domain\Base\BuilderFactory;
use Src\Domain\Entity\UserEntity\UserEntity;
use Src\Infrastructure\Abstracts\IDbContext;


class Eloquent extends EloquentDb implements IDbContext
{

    /**
     * @var IEntity|Model|Builder
    */
    public $entity; //data db

    public $column;

    /**
     * ok
     * Eloquent constructor.
     * @throws BaseException
     */
    public function __construct()
    {
        try{
            $this->startTransaction();
            parent::__construct();
        }catch (PDOException $exception){
            throw new BaseException("Eloquent","fails connect ".$exception->getMessage());
        }
        catch (\mysql_xdevapi\Exception $exception){
            throw new BaseException("Eloquent","fails connect ".$exception->getMessage());
        }
        catch (Exception $exception){
            throw new BaseException("Eloquent","fails connect ".$exception->getMessage());
        }finally{
            return;
        }
    }


    /**
     * @param string $entity
     * @param array $dataEntity
     * @return Eloquent
     */
    public function DbSet(string $entity, $dataEntity = []){
        //add entity
        $this->fillable = $dataEntity[$entity]["fillable"];
        $this->fillable($this->fillable);
        $this->timestamps = $dataEntity[$entity]["timestamps"];
        $this->setTable($dataEntity[$entity]["entity"]);
        return $this;
    }

    /**
     * @param string $entity
     * @return Builder
     */
    public function DB(string $entity){
        return DB::table($entity);
    }

    /**
     * @param IEntity|object $entity
     * @return int
     */
    public function SaveChanges(object $entity): int{
        if(!$entity){
            $this->startRollback($this->table);
            return 0;
        }
        $this->startCommit($this->table);
        return 1;
    }

    /**
     * @param string $entity
     */
    public function startCommit(string $entity): void{
        DB::commit();
    }

    /**
     * @param string $entity
     */
    public function startRollback(string $entity): void{
        DB::rollBack();
    }


    /**
     * @param int $id
     * @return IDbContext
     */
    public function find(int $id): IDbContext
    {
        $this->entity = parent::find($id);
        return $this;
    }


    public function getEntity(){
        return $this->entity->toArray();
    }





    /**
     * @param array $where
     * @return IDbContext
     */
    public function where(array $where = []): IDbContext
    {
        $this->entity = parent::where($where);
        return $this;
    }

    /**
     * @param string $column
     * @param string $direction
     * @return IDbContext
     */
    public function orderBy(string $column = "id", string $direction = "asc"): IDbContext
    {
        $this->entity = $this->entity->orderBy($column,$direction);
        return $this;
    }

    /**
     * @param int $count
     * @return IDbContext
     */
    public function take(int $count): IDbContext
    {
        $this->entity = $this->entity->take($count);
        return $this;
    }

    /**
     * @param array $column
     * @return object
     */
    public function get(array $column = ["*"]): object
    {
        return  $this->entity->get($column);
    }

    /**
     * @param array $column
     * @return IDbContext
     */
    public function getAll(array $column = []): IDbContext
    {
        $this->entity = parent::where([])->get();
        return $this;
    }


    /**
     * @param array $entity
     * @return IDbContext
     * @throws BaseException
     */
    public function add(array $entity): IDbContext
    {
        try{
            $this->entity = $this->fill($entity);
            $this->entity->save();
            return $this;
        } catch (\PDOException $exception){
            $this->startRollback($this->table);
            throw new BaseException($this->table,$exception->getMessage());
        } catch (\Exception $exception){
            $this->startRollback($this->table);
            throw new BaseException($this->table,$exception->getMessage());
        }
    }

    /**
     * @param array $entities
     * @return bool
     * @throws BaseException
     */
    public function addRange(array $entities): bool
    {
        try{
            return $this->DB($this->getTable())->insert($entities);
        } catch (\PDOException $exception){
            $this->_db->startRollback($this->table);
            throw new BaseException($this->table,$exception->getMessage());
        } catch (\Exception $exception){
            $this->_db->startRollback($this->table);
            throw new BaseException($this->table,$exception->getMessage());
        }
    }

    /**
     * @param object|null|IEntity $entity
     * @return bool
     * @throws BaseException
     */
    public function del(object $entity = null): bool
    {

        try{
            if($entity){
                return parent::where([$this->primaryKey=>$entity->getId()])->delete() > 0;
            }
            return parent::where()->delete() > 0;
        } catch (\PDOException $exception){
            $this->startRollback($this->table);
            throw new BaseException($this->table,$exception->getMessage());
        } catch (\Exception $exception){
            $this->startRollback($this->table);
            throw new BaseException($this->table,$exception->getMessage());
        }
    }


    /**
     * @param array|null $entity
     * @param string $column
     * @return bool
     * @throws BaseException
     */
    public function deleteRange(array $entity = null, string $column = "id") : bool {
        return parent::whereIn($column, $this->keys($entity,$column))->delete();
    }

    /**
     * @param object|null|IEntity $entity
     * @return bool
     * @throws BaseException
     */
    public function edit(object $entity =null): bool
    {
        try{
            return parent::where([$this->primaryKey=>$entity->getId()])->update($entity->toArray()) > 0;
        } catch (\PDOException $exception){
            $this->startRollback($this->table);
            throw new BaseException($this->table,$exception->getMessage());
        } catch (\Exception $exception){
            $this->startRollback($this->table);
            throw new BaseException($this->table,$exception->getMessage());
        }
    }

    /**
     * @param string $column
     * @param array $whereIn
     * @return IDbContext
     * @throws BaseException
     */
    public function whereIn(array $whereIn = [],string $column = "id"): IDbContext
    {
        try{
           $this->entity = parent::whereIn($column, $this->keys($whereIn));
        } catch (\PDOException $exception){
            $this->_db->startRollback($this->table);
            throw new BaseException($this->table,$exception->getMessage());
        } catch (\Exception $exception){
            $this->_db->startRollback($this->table);
            throw new BaseException($this->table,$exception->getMessage());
        }
        return $this;
    }

    /**
     * @param array $whereIn
     * @param string $column
     * @return array
     * @throws BaseException
     */
    public function keys(array $whereIn = [], string $column = "id"){
        $data = [];
        $this->column = $column;
        foreach ($whereIn as $row){
            array_push($data,BuilderFactory::Builder(UserEntity::class,$row)->toArray());
        }
        return array_map(function($item){ return $item["$this->column"]; }, $data);
    }

    /**
     *
     */
    public function startTransaction(): void
    {
        DB::beginTransaction();
    }

    public function __destruct()
    {
    }
}


