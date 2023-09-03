<?php

declare(strict_types=1);

namespace app\service;

use app\common\CsvDelimiters;
use app\common\UserTextDTO;
use Iterator;

class FileService
{
    public function getAllFilesNameTexts(): array
    {
        $allFilesNameTexts = scandir('files/text');
        $allFilesNameTextsWithUserId = [];
        foreach ($allFilesNameTexts as $filesNameText) {
            $arrayFromFileName = explode('-', $filesNameText);
            $userId = (int)$arrayFromFileName[0];
            $allFilesNameTextsWithUserId[$userId][] = $filesNameText;
        }
        return $allFilesNameTextsWithUserId;
    }

    public function getUserFromCsv(string $delimiter): Iterator
    {
        $users = new \SplFileObject('files/people.csv');
        $users->setFlags(\SplFileObject::READ_CSV);
        while (!$users->eof()) {
            yield $users->fgetcsv(CsvDelimiters::$delimiters[$delimiter]);
        }
    }

    public function getUserTexts(array $user, array $allFilesNameTexts): ?UserTextDTO
    {
        if (isset($user[1])) {
            $userIdCsv = (int)$user[0];
            $userNameCsv = $user[1];

            $textsUser = [];
            if (isset($allFilesNameTexts[$userIdCsv])) {
                foreach ($allFilesNameTexts[$userIdCsv] as $fileNameTextUser) {
                    $textsUser[] = file_get_contents('files/text/' . $fileNameTextUser);
                }
            }
            return new UserTextDTO($userIdCsv, $userNameCsv, $textsUser);
        }
        return null;
    }

    public function saveChangesTextsUser(int $userId, int $numberText, string $text): void
    {
        $numberText = sprintf('%03d', $numberText);
        $fileName = "$userId-$numberText.txt";
        file_put_contents('files/output_text/' . $fileName, $text);
    }
}