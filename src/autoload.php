<?php

spl_autoload_register(
    function($class) {
        static $classes = null;
        if ($classes === null) {
            $classes = array(
                //domian base
                'src\\Domain\\Base\\IEntity' => '/Domain/Base/IEntity.php',
                'src\\Domain\\Base\\Entity' => '/Domain/Base/Entity.php',
                'src\\Domain\\Base\\IRepository' => '/Domain/Base/IRepository.php',
                'src\\Domain\\Base\\BaseException' => '/Domain/Base/BaseException.php',
                'src\\Domain\\Base\\BuilderFactory' => '/Domain/Base/BuilderFactory.php',

                //domain abstract
                'src\\Domain\\Abstracts\\IException' => '/Domain/Abstracts/IException.php',
                'src\\Domain\\Abstracts\\IUnitOfWork' => '/Domain/Abstracts/IUnitOfWork.php',

                //entity
                'src\\Domain\\Entity\\UserEntity\\UserEntity' => '/Domain/Entity/UserEntity/UserEntity.php',
                'src\\Domain\\Entity\\UserEntity\\IUserEntityFactory' => '/Domain/Entity/UserEntity/IUserEntityFactory.php',
                'src\\Domain\\Entity\\UserEntity\\Service\\MailerAdapterInterface' => '/Domain/Entity/UserEntity/Service/MailerAdapterInterface.php',
                'src\\Domain\\Entity\\UserEntity\\Service\\MailerFactory' => '/Domain/Entity/UserEntity/Service/MailerFactory.php',
                'src\\Domain\\Entity\\UserEntity\\Event\\RegisterEvent' => '/Domain/Entity/UserEntity/Event/RegisterEvent.php',


            );
        }

        $cn = strtolower($class);
        if (isset($classes[$cn])) {
            require __DIR__ . $classes[$cn];
        }
    },
    true,
    false
);
