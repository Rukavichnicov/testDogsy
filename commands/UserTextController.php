<?php

declare(strict_types=1);

namespace app\commands;

use app\common\CsvDelimiters;
use app\common\UserTextCommands;
use app\factory\UserTextHandlerFactory;
use app\service\FileService;
use yii\base\UserException;
use yii\console\Controller;

class UserTextController extends Controller
{
    private UserTextHandlerFactory $handlerFactory;

    private FileService $fileService;

    public function __construct($id, $module, $config = [])
    {
        $this->handlerFactory = \Yii::$container->get(UserTextHandlerFactory::class);
        $this->fileService = \Yii::$container->get(FileService::class);
        parent::__construct($id, $module, $config);
    }

    /**
     * @throws UserException
     */
    public function actionIndex(string $delimiter, string $command)
    {
        $this->validate($delimiter, $command);
        $handler = $this->handlerFactory->create($command);
        $allFilesNameTexts = $this->fileService->getAllFilesNameTexts();
        foreach ($this->fileService->getUserFromCsv($delimiter) as $user) {
            $userTextDTO = $this->fileService->getUserTexts($user, $allFilesNameTexts);
            if ($userTextDTO !== null) {
                $handler->handleTextUser($userTextDTO);
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
