<?php

declare(strict_types=1);

namespace app\handlers\userText;

interface UserTextHandlerInterface
{
    public function handleTextUser(): void;
}