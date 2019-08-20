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
 * @name IEntity
 * @file /src/Domain/Abstracts/IEntity.php
 * @observations example IEntity domain entity
 *
 */

namespace Src\Domain\Abstracts;


interface IEntity
{
    /**
     * @return int
     */
    public function getId(): int;
    /**
     * @param int $id
     */
    public function setId(int $id): void;

    public function toArray();
}
