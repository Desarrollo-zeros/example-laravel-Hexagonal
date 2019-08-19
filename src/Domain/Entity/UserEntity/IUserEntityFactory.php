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
 * @name IUserEntityFactory
 * @file /src/Domain/Entity/UserEntity/IUserEntityFactory.php
 * @observations example IUserEntityFactory domain entity
 *
 */

namespace Src\Domain\Entity\UserEntity;


interface IUserEntityFactory
{
    public static function createUser(string $username, string $password, string $email,int $id = 0);

    public static function builder(string $instance, $data);

}

