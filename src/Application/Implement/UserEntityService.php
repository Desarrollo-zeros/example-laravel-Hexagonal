<?php

namespace Src\Application\Implement;

use Src\Application\Base\EntityService;
use Src\Domain\Abstracts\IEntity;
use Src\Domain\Abstracts\IRepository;
use Src\Domain\Abstracts\IUnitOfWork;

class UserEntityService extends EntityService
{
    public function __construct(IUnitOfWork $iUnitOfWork, IRepository $repository)
    {
        parent::__construct(
            $iUnitOfWork,
            $repository
        );
    }

}
