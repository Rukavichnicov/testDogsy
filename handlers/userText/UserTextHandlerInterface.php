<?php

declare(strict_types=1);

namespace app\handlers\userText;

use app\common\UserTextDTO;

interface UserTextHandlerInterface
{
    public function handleTextUser(UserTextDTO $userTextDTO): void;
}