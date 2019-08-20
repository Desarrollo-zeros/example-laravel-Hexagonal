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
 * @name ICollection
 * @file /src/Domain/Infrastructure/Abstracts/IDBBaseContext.php
 * @observations example IDBBaseContext domain entity
 *
 */

namespace Src\Infrastructure\Abstracts;



use Src\Infrastructure\Base\ORM\Eloquent\Eloquent;
use Src\Infrastructure\Base\ORM\ORM;

interface IDBBaseContext
{
    /**
     * @param string $entity
     * @return ORM|Eloquent
     */
    public function DbSet(string $entity);
    public function getDataEntity();
    public function setDataEntity($dataEntity);
}
