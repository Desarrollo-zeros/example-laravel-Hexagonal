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
 * @name MailerFactory
 * @file /src/Domain/Entity/UserEntity/Setvice/MailerFactory.php
 * @observations example MailerFactory domain entity
 *
 */

namespace Src\Domain\Entity\UserEntity\Service;


class MailerFactory
{
    /**
     * @var MailerAdapterInterface
    */
    private $adapter;

    /**
     * @var string
    */
    private  $subject;
    /**
     * @var string
     */
    private  $body;

    public function __construct(MailerAdapterInterface $adapter, $subject = "welcome", $body = "test")
    {
        $this->adapter = $adapter;
        $this->body = $body;
        $this->subject = $subject;
    }

    public function sendRegistrationEmail($email)
    {
        $this->adapter->send($email,$this->subject,$this->body);
    }
}
