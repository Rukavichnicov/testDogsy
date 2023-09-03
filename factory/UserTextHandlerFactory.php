<?php

declare(strict_types=1);

namespace app\factory;

use app\common\UserTextCommands;
use app\handlers\userText\UserTextHandlerInterface;

class UserTextHandlerFactory
{
    public function create($command): UserTextHandlerInterface
    {
        return new UserTextCommands::$commandsClasses[$command];
    }
}