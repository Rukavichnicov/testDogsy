<?php

declare(strict_types=1);

namespace app\handlers\userText;

class CountAverageLineCountHandler implements UserTextHandlerInterface
{
    public function handleTextUser(): void
    {
        echo 'countAverageLineCount' . PHP_EOL;
    }
}