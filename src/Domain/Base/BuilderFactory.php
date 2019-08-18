<?php


namespace Src\Domain\Base;


use Src\Domain\Entity\UserEntity\IUserEntityFactory;
use Src\Domain\Entity\UserEntity\UserEntity;


class BuilderFactory implements IUserEntityFactory
{
    /**
     * @param int $id
     * @param string $username
     * @param string $password
     * @param string $email
     * @return UserEntity
     * @throws BaseException
     */
    public static function createUser(int $id, string $username, string $password, string $email)
    {
        if(!isset($id)  || !isset($username) || !isset($password) || !isset($email)){
            throw new BaseException("UserEntity","Error in Transaction, start rollBack in entity UserEntity");
        }
        return new UserEntity($id,$username,$password,$email);
    }
}
