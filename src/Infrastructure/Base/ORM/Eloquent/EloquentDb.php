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
 * @name EloquentDb
 * @file /src/Infrastructure/Base/Eloquent
 * @observations example EloquentDb domain entity
 *
 */
namespace Src\Infrastructure\Base\ORM\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;



class EloquentDb extends Model
{
    /**
     * EloquentDb constructor.
     *
     */
    protected function __construct()
    {
        parent::__construct();
    }

}
