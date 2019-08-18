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
 * @name MailerAdapterInterface
 * @file /src/Domain/Entity/UserEntity/Setvice/MailerAdapterInterface.php
 * @observations example MailerAdapterInterface domain entity
 *
 */

namespace src\Domain\Entity\UserEntity\Service;


interface MailerAdapterInterface
{
    /**
     * @param string $email
     * @param string $subject
     * @param string $body
     * @return bool
     */
    public function send(string $email, string $subject, string  $body) : bool;
}
