<?php

declare(strict_types=1);

namespace app\handlers\userText;

use app\common\UserTextDTO;

class ReplaceDatesHandler implements UserTextHandlerInterface
{
    public function handleTextUser(UserTextDTO $userTextDTO): void
    {
        $countReplace = 0;
        if (!empty($userTextDTO->texts)) {
            foreach ($userTextDTO->texts as $numberText => $text) {
                $datesInText = [];
                preg_match_all('~\d{2}/\d{2}/\d{2}~', $text, $datesInText);
                $countReplace += count($datesInText[0]);
                foreach ($datesInText[0] as $date) {
                    $dateObject = \DateTime::createFromFormat('d/m/y', $date);
                    $dateNewFormat = $dateObject->format('m-d-Y');
                    $text = preg_replace('~\d{2}/\d{2}/\d{2}~', $dateNewFormat, $text);
                    $numberText = sprintf('%03d', $numberText + 1);
                    $fileName = $userTextDTO->id . '-' . $numberText . '.txt';
                    file_put_contents('files/output_text/' . $fileName, $text);
                }

            }
        }
        echo "Пользователь id: $userTextDTO->id, name: $userTextDTO->name - Количество заменённых дат: $countReplace" . PHP_EOL;
    }
}