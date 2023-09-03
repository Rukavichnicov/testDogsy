<?php

declare(strict_types=1);

namespace app\common;

use app\handlers\userText\CountAverageLineCountHandler;
use app\handlers\userText\ReplaceDatesHandler;

class UserTextCommands
{
    public const COUNT_AVERAGE_LINE_COUNT = 'countAverageLineCount';
    public const REPlACE_DATES = 'replaceDates';

    public static array $commandsClasses = [
        self::COUNT_AVERAGE_LINE_COUNT => CountAverageLineCountHandler::class,
        self::REPlACE_DATES => ReplaceDatesHandler::class,
    ];
}