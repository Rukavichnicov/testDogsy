<?php

declare(strict_types=1);

namespace app\commands;

use yii\console\Controller;

class UserTextController extends Controller
{
    public function actionIndex(string $delimiter, string $command)
    {
        echo $delimiter . PHP_EOL;
        echo $command. PHP_EOL;
    }
}
