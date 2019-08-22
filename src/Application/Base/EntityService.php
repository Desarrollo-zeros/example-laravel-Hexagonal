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
 * @name EntityService
 * @file /src/Domain/Aplication/Base/EntityService.php
 * @observations example EntityService domain entity
 *
 */

namespace Src\Application\Base;

use Exception;
use http\Env\Response;
use Src\Application\Abstracts\IEntityService;
use Src\Domain\Abstracts\IEntity;
use Src\Domain\Abstracts\IRepository;
use Src\Domain\Abstracts\IUnitOfWork;
use Src\Domain\Base\BaseException;
use Src\Domain\Base\Entity;
use Src\Infrastructure\Base\Collection;

abstract class EntityService implements IEntityService
{
    /**
     * @var IUnitOfWork
     */
    protected $iUnitOfWork;
    /**
     * @var IRepository
     */
    protected $repository;

    private $response;


    public function __construct(IUnitOfWork $iUnitOfWork, IRepository $repository)
    {
        $this->iUnitOfWork = $iUnitOfWork;
        $this->repository = $repository;
        $this->response = new ServiceResponse();

    }

    /**
     * @param int $id
     * @return array|\JsonSerializable|object|IEntity|Response
     */
    public function find(int $id)
    {
        if ($id == 0)
        {
            return $this->response->responseError("id not null");
        }

        try
        {
            return $this->response->responseSuccess("entity",$this->repository->find($id));
        } catch (Exception $exception)
        {
            return  $this->response->responseError($exception->getMessage());
        }
    }

    /**
     * @param array $entity
     * @return array|object|Response
     */
    public function findBy(array $entity = [])
    {
        if (empty($entity))
        {
            return  $this->response->responseError("Finder not null");
        }
        try
        {
            return $this->response->responseSuccess("entity",$this->repository->findBy($entity)->get());
        } catch (Exception $exception)
        {
            $this->response->responseError($exception->getMessage());
        }
    }

    /**
     * @param IEntity $entity
     * @return array|bool|\JsonSerializable|object|Response
     */
    public function create(IEntity $entity)
    {
        $entity->setId(0);
        if ($entity == null)
        {
            return  $this->response->responseError("Entity null");
        }
        try
        {
            $entity = $this->repository->add($entity);
            if ($entity != null)
            {
                //$this->iUnitOfWork->setEntity($entity); //optional
                 if($this->iUnitOfWork->commit() > 0){
                     return $this->response->responseSuccess("entity",$entity);
                 }else{
                     return  $this->response->responseError("Fail save to entity");
                 }
            }
        } catch (Exception $exception)
        {
            return  $this->response->responseError($exception->getMessage());
        }

        return false;
    }

    /**
     * @param IEntity $entity
     * @return bool|object|Response
     */
    public function delete(IEntity $entity)
    {
        if ($entity == null)
        {
            return  $this->response->responseError("Entity null");
        }
        try
        {
            $this->repository->del($entity);
            if($this->iUnitOfWork->commit() > 0){
                return $this->response->responseSuccess("entity",$entity);
            }else{
                return  $this->response->responseError("Fail delete to entity");
            }
        } catch (Exception $exception)
        {
            return  $this->response->responseError($exception->getMessage());
        }
    }

    /**
     * @return array|\JsonSerializable|object|Response
     */
    public function getAll()
    {
        try
        {
            return $this->response->responseSuccess("entity",$this->repository->getAll());
        } catch (Exception $exception)
        {
            return  $this->response->responseError($exception->getMessage());
        }
    }

    /**
     * @param IEntity $entity
     * @return array|bool|\JsonSerializable|object|Response
     */
    public function update(IEntity $entity)
    {
        if ($entity == null)
        {
            return  $this->response->responseError("Entity null");
        }
        try
        {
            $this->repository->edit($entity);
            if($this->iUnitOfWork->commit() > 0){
                return $this->response->responseSuccess("entity",$entity);
            }else{
                return  $this->response->responseError("Fail update to entity");
            }
        } catch (Exception $exception)
        {
            return  $this->response->responseError($exception->getMessage());
        }
    }
}
