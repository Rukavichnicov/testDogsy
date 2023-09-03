<?php

declare(strict_types=1);

namespace app\common;

class UserTextDTO
{
    public function __construct(
        public int $id,
        public string $name,
        public array $texts,
    ) {
    }
}