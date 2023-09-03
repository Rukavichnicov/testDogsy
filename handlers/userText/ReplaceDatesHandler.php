<?php

declare(strict_types=1);

namespace app\handlers\userText;

use app\common\UserTextDTO;
use app\service\FileService;

class ReplaceDatesHandler implements UserTextHandlerInterface
{
    public function __construct(public FileService $fileService)
    {
    }

    public function handleTextUser(UserTextDTO $userTextDTO): void
    {
        $countReplace = 0;
        if (!empty($userTextDTO->texts)) {
            foreach ($userTextDTO->texts as $numberText => $text) {
                $datesInText = [];
                $initialDatePattern = '~\d{2}/\d{2}/\d{2}~';
                preg_match_all($initialDatePattern, $text, $datesInText);
                $foundDates = $datesInText[0] ?? [];
                $countReplace += count($foundDates);
                if (!empty($foundDates)) {
                    foreach ($foundDates as $date) {
                        $dateObject = \DateTime::createFromFormat('d/m/y', $date);
                        $dateNewFormat = $dateObject->format('m-d-Y');
                        $text = preg_replace($initialDatePattern, $dateNewFormat, $text);

                        $this->fileService->saveChangesTextsUser($userTextDTO->id, $numberText + 1, $text);
                    }
                } else {
                    $this->fileService->saveChangesTextsUser($userTextDTO->id, $numberText + 1, $text);
                }
            }
        }
        echo "Пользователь id: $userTextDTO->id, name: $userTextDTO->name - Количество заменённых дат: $countReplace" . PHP_EOL;
    }
}