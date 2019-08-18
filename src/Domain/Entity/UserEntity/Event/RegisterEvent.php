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
 * @name RegisterEvent
 * @file /src/Domain/Entity/UserEntity/Event/RegisterEvent.php
 * @observations example RegisterEvent domain entity
 *
 */

namespace src\Domain\Entity\UserEntity\Event;


use DateTime;

class RegisterEvent
{

    /**
     * @var int
    */
    private $userId = 0;

    /**
     * @var DateTime
     */
    private $currentOn = null;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
        $this->currentOn = new DateTime();
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return DateTime
     */
    public function getCurrentOn(): DateTime
    {
        return $this->currentOn;
    }

    /**
     * @param DateTime $currentOn
     */
    public function setCurrentOn(DateTime $currentOn): void
    {
        $this->currentOn = $currentOn;
    }

}
