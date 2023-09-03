<?php

declare(strict_types=1);

namespace app\commands;

use app\common\CsvDelimiters;
use app\common\UserTextCommands;
use app\factory\UserTextHandlerFactory;
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
        $handler->handleTextUser();
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
            throw new UserException('Данная комманда не поддерживается.');
        }
    }
}
