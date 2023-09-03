<?php

declare(strict_types=1);

namespace app\handlers\userText;

class ReplaceDatesHandler implements UserTextHandlerInterface
{
    public function handleTextUser(): void
    {
        echo 'replaceDates' . PHP_EOL;
    }
}