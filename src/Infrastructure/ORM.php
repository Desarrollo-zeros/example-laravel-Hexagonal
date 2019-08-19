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
 * @file /src/Infrastructure/ORMphp
 * @observations example ORM domain entity
 *
 */

namespace Src\Infrastructure;


use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use PDOException;
use Src\Domain\Base\BaseException;
use Src\Domain\Base\IEntity;
use Src\Infrastructure\Base\IDbContext;

class ORM extends Model implements IDbContext
{

    protected $table = "user"; //change table or entity
    public $timestamps = false;
    protected $attributes = [];
    protected $fillable = [];

    /**
     * ORM constructor.
     * @param string $table
     * @throws BaseException
     */
    public function __construct($table = "")
    {
        try{
            parent::__construct();
            $this->table = !empty($table) ? $table : $this->table;
        }catch (PDOException $exception){
            throw new BaseException("ORM","fails connect ".$exception->getMessage());
        }
        catch (\mysql_xdevapi\Exception $exception){
            throw new BaseException("ORM","fails connect ".$exception->getMessage());
        }
        catch (Exception $exception){
            throw new BaseException("ORM","fails connect ".$exception->getMessage());
        }finally{
            return;
        }
    }

    /**
     * @param string $entity
     * @return Model
     */
    public function DbSet(string $entity): Model{}// TODO: Implement DbSet() method.

    /**
     * @param string $entity
     * @return Builder
     */
    public function DB(string $entity){
        return DB::table($entity);
    }// TODO: Implement DB() method.

    /**
     * @param IEntity|object $entity
     * @return int
     */
    public function SaveChanges(object $entity): int{}// TODO: Implement SaveChanges() method.

    /**
     * @param string $entity
     */
    public function startCommit(string $entity): void{
        DB::commit();
    }// TODO: Implement startCommit() method.

    /**
     * @param string $entity
     */
    public function startRollback(string $entity): void{
        DB::rollBack();
    }// TODO: Implement startRollback() method.


}


