<?php

declare(strict_types=1);

namespace app\factory;

use app\common\UserTextCommands;
use app\handlers\userText\CountAverageLineCountHandler;
use app\handlers\userText\ReplaceDatesHandler;
use app\handlers\userText\UserTextHandlerInterface;
use app\service\FileService;

class UserTextHandlerFactory
{
    public function create($command): UserTextHandlerInterface
    {
        return match ($command) {
            UserTextCommands::COUNT_AVERAGE_LINE_COUNT => new CountAverageLineCountHandler(),
            UserTextCommands::REPlACE_DATES => new ReplaceDatesHandler(new FileService()),
        };
    }
}