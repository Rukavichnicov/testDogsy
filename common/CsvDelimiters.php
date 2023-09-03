<?php

declare(strict_types=1);

namespace app\common;

class CsvDelimiters
{
    public const COMMA = 'comma';
    public const SEMICOLON = 'semicolon';
    public static array $delimiters = [
        self::COMMA => ',',
        self::SEMICOLON => ';',
    ];
}