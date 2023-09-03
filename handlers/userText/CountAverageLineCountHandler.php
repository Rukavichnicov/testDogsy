<?php

declare(strict_types=1);

namespace app\handlers\userText;

use app\common\UserTextDTO;

class CountAverageLineCountHandler implements UserTextHandlerInterface
{
    public function handleTextUser(UserTextDTO $userTextDTO): void
    {
        $averageNumberRows = 0;
        if (!empty($userTextDTO->texts)) {
            $sumNumberRows = 0;
            $countTexts = count($userTextDTO->texts);
            foreach ($userTextDTO->texts as $text) {
                $sumNumberRows += substr_count($text, PHP_EOL) + 1;
            }
            $averageNumberRows = round($sumNumberRows / $countTexts, 1);
        }
        echo "Пользователь id: $userTextDTO->id, name: $userTextDTO->name - Среднее количество строк в текстах: $averageNumberRows" . PHP_EOL;
    }
}