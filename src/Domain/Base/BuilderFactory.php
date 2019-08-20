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
    public static function createUser(string $username, string $password, string $email,int $id = 0)
    {
        if(empty($username) || empty($password) || empty($email)){
            throw new BaseException(UserEntity::class,"Error in Transaction, start rollBack in entity UserEntity");
        }
        return new UserEntity($id,$username,$password,$email);
    }


    /**
     * @param string $instance
     * @param $data
     * @return object|UserEntity
     * @throws BaseException
     */
    public static function Builder(string $instance, $data){
        $data = (object)$data;

        switch ($instance){
            case UserEntity::class:{
                return new UserEntity($data->id,$data->username,$data->password,$data->email);
            }
        }
        return $data;
    }





}
