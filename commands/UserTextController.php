<?php

declare(strict_types=1);

namespace app\commands;

use app\common\CsvDelimiters;
use app\common\UserTextCommands;
use app\common\UserTextDTO;
use app\factory\UserTextHandlerFactory;
use SplFileObject;
use yii\base\UserException;
use yii\console\Controller;

class UserTextController extends Controller
{
    private UserTextHandlerFactory $handlerFactory;

    public function __construct($id, $module, $config = [])
    {
        $this->handlerFactory = \Yii::$container->get(UserTextHandlerFactory::class);
        parent::__construct($id, $module, $config);
    }

    /**
     * @throws UserException
     */
    public function actionIndex(string $delimiter, string $command)
    {
        $this->validate($delimiter, $command);

        $handler = $this->handlerFactory->create($command);

        $allFilesNameTexts = scandir('files/text');
        $allTextsWithUserId = [];
        foreach ($allFilesNameTexts as $filesNameText) {
            $arrayFromFileName = explode('-', $filesNameText);
            $userId = (int)$arrayFromFileName[0];
            $allTextsWithUserId[$userId][] = $filesNameText;
        }

        $users = new SplFileObject('files/people.csv');
        $users->setFlags(SplFileObject::READ_CSV);
        while (!$users->eof()) {
            $user = $users->fgetcsv(CsvDelimiters::$delimiters[$delimiter]);
            if (isset($user[1])) {
                $userIdCsv = (int)$user[0];
                $userNameCsv = $user[1];

                $textsUser = [];
                if (isset($allTextsWithUserId[$userIdCsv])) {
                    foreach ($allTextsWithUserId[$userIdCsv] as $fileNameTextUser) {
                        $textsUser[] = file_get_contents('files/text/' . $fileNameTextUser);
                    }
                }

                $handler->handleTextUser(new UserTextDTO($userIdCsv, $userNameCsv, $textsUser));
            }
        }
    }

    /**
     * @throws UserException
     */
    private function validate(string $delimiter, string $command): void
    {
        if (!isset(CsvDelimiters::$delimiters[$delimiter])) {
            throw new UserException('Данный разделитель не поддерживается.');
        }
        if (!isset(UserTextCommands::$commandsClasses[$command])) {
            throw new UserException('Данная команда не поддерживается.');
        }
    }
}
