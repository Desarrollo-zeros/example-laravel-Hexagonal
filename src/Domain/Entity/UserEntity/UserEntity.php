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
 * @name UserEntity
 * @file /src/Domain/Entity/UserEntity/UserEntity.php
 * @observations example User domain entity
 *
 */

namespace Src\Domain\Entity\UserEntity;

use Src\Domain\Base\BaseException;
use Src\Domain\Base\Entity;


class UserEntity extends Entity
{

    /**
     * Column("name"="username","type"="string");
     * @var string
     */
    private  $username;
    /**
     * Column("name"="password","type"="string");
     * @var string
     */
    private  $password;
    /**
     * Column("name"="email","type"="string");
     * @var string
     */
    private  $email;


    /**
     * UserEntity constructor.
     * @param int $id
     * @param string $username
     * @param string $password
     * @param string $email
     * @observations overloaded constructor
     * @throws BaseException
     */
    public function __construct(int $id, string $username, string $password, string $email){
        $this->id = $id;

        if(strlen($username) < 3){
            throw new BaseException(UserEntity::class,"Username no empty length < 3");
        }

        if(strlen($password) < 3){
            throw new BaseException(UserEntity::class,"Password no empty length < 3");
        }

        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            throw new BaseException(UserEntity::class,"email invalid");
        }
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return sha1($this->password);
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public  function toArray() : array {
        return [
            "id" => $this->getId(),
            "username" => $this->getUsername(),
            "password" => $this->getPassword(),
            "email" => $this->getEmail(),
        ];
    }


}
