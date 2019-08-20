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



use Src\Application\Abstracts\IEntityService;
use Src\Domain\Abstracts\IRepository;
use Src\Domain\Abstracts\IUnitOfWork;
use Src\Infrastructure\Base\Collection;

abstract class EntityService extends Collection implements IEntityService
{

    /**
     * @var IUnitOfWork
    */
    protected $iUnitOfWork;

    /**
     * @var IRepository
    */
    protected $repository;

    public function __construct(IUnitOfWork $iUnitOfWork, IRepository $repository){
         parent::__construct();
    }
    /**
     * @return object
     */
    public function find(): object
    {

    }

    /**
     * @return array
     */
    public function findBy(): array
    {
        // TODO: Implement findBy() method.
    }

    /**
     * @return object
     */
    public function create(): object
    {
        // TODO: Implement create() method.
    }

    /**
     * @return bool
     */
    public function delete(): bool
    {
        // TODO: Implement delete() method.
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        // TODO: Implement getAll() method.
    }

    /**
     * @return bool
     */
    public function update(): bool
    {
        // TODO: Implement update() method.
    }
}
