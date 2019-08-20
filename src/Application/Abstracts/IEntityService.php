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
 * @name IEntityService
 * @file /src/Domain/Aplication/Abstracts/IEntityService.php
 * @observations example IEntityService domain entity
 *
 */


namespace Src\Application\Abstracts;


use Src\Domain\Abstracts\IRepository;
use Src\Domain\Abstracts\IUnitOfWork;

/**
 * Interface IEntityService
 * @package Src\Application\Abstracts
 */
interface IEntityService
{

    public function __construct(IUnitOfWork $iUnitOfWork, IRepository $repository);

    /**
     * @return object
     */
    public function find() : object;

    /**
     * @return array
     */
    public function findBy() : array;

    /**
     * @return object
     */
    public function create() : object;

    /**
     * @return bool
     */
    public function delete(): bool;

    /**
     * @return array
     */
    public function getAll() : array;

    /**
     * @return bool
     */
    public function update() : bool;
}
