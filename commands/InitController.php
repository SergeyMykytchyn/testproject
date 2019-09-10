<?php

namespace app\commands;

use app\models\User;
use yii\console\Controller;
use yii\console\ExitCode;


class InitController extends Controller
{
    public function actionAddDefaultUser()
    {
        $user = new User(['login' => 'admin']);
        $user->passhash = \Yii::$app->getSecurity()->generatePasswordHash('password');
        $user->save(false);
    }
}
