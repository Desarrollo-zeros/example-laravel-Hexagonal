<?php

namespace Src\Test\Application\Base;

use Illuminate\Database\Eloquent\Builder;
use Src\Application\Base\EntityService;
use Src\Application\Implement\UserEntityService;
use Src\Domain\Abstracts\IUnitOfWork;
use Src\Domain\Base\BaseException;
use Src\Domain\Base\BuilderFactory;
use Src\Domain\Entity\UserEntity\UserEntity;
use Src\Infrastructure\Base\Repository\GenericRepository;
use Src\Infrastructure\DBContext;
use Src\Test\Application\singleton\SingletonDBContext;
use Src\Test\Application\singleton\SingletonRepository;
use Src\Test\Application\singleton\SingletonUnitWork;
use Src\Test\Test;

class EntityServiceTest extends Test
{
    /**
     * @var UserEntity
     */
    private $user;

    /**
     * @var DBContext
     */
    private $connection;

    /**
     * @var GenericRepository
     */
    private $repository;


    /**
     * @var IUnitOfWork
     */
    private $unitOfWork;
    /**
     * @var Builder
     */

    /**
     * @var EntityService
    */
    private $entityService;

    private $dbException = '{"Entity":"Eloquent","status":true,"message":"fails connect"}';


    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub


        //init db
        try {
            $this->connection = SingletonDBContext::getInstance();
        } catch (BaseException $e) {
            echo $e->getMessage();
        }
        $this->unitOfWork = SingletonUnitWork::getInstance();
        $this->repository = SingletonRepository::getInstance(UserEntity::class);
        $this->user =  BuilderFactory::createUser("zerosEntity","toor","zerosEntity@gmail.com",1);
        $this->entityService = new UserEntityService($this->unitOfWork,$this->repository);
    }

    /**
     * @test exits connexion
     * @connexion default table = "user"
     */
    public function is_connexion(){
        //test exist object connexion pdo
        $pdo = $this->connection->getDb()->getConnection()->getPdo();

        $this->assertIsObject($pdo);
        if($pdo){
            $this->prontoPrint("test connexion ok ","success");
        }else{
            $this->prontoPrint("test connexion fail ","error");
        }

        $dbName1 = $this->connection->getDb()->getConnection()->getDatabaseName();
        $dbName2 = env("DB_DATABASE");
        $this->assertEquals($dbName1,$dbName2);

        if($dbName1 == $dbName2){
            $this->prontoPrint("test database name ok ","success");
        }else{
            $this->prontoPrint("test database name fail ","error");
        }

        $this->assertEquals("user",$this->connection->getDb()->getTable()); //table user
        $this->prontoPrint("test table name user ","success");


        //$this->connection->getDb()->setTable("test");
        //$this->assertEquals($this->connection->getDb()->getTable(),"test"); //change test
        //$this->prontoPrint("test table change user to test ","success");
    }

    /**
     * @test
    */
    public function find(){
        $user = $this->entityService->find(1);
        $this->assertEquals($user->getEntity()->getUsername(),"zeros");

    }

    /**
     * @test
     */
    public function findBy(){
        $user = $this->entityService->findBy(["id"=>1]);
        $this->assertEquals($user->getEntity()->getUsername(),"zeros");
    }

    /**
     * @test
     */
    public function del(){
        $user = $this->entityService->delete($this->user);
        $this->assertEquals($user->getStatusCode(),200);
    }

    /**
     * @test
    */
    public function create(){
        $user = $this->entityService->create($this->user);
        $this->assertEquals($user->getStatusCode(),200);
    }

    /**
     * @test
     */
    public function getAll(){
        $users = $this->entityService->getAll();
        $this->assertIsArray($users->getEntity());
    }

    /**
     * @test
    */
    public function update(){
        $user =  BuilderFactory::createUser("zeros","toor","wowzeros2@gmail.com",1);
        $this->repository->add($user);
        $user->setEmail("wowzeros@gmail.com");
        $user = $this->entityService->update($user);
        $this->assertEquals($user->getStatusCode(),200);
    }
}
