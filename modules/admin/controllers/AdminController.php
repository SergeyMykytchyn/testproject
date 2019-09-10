<?php

namespace app\modules\admin\controllers;

use app\models\LoginForm;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;


class AdminController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'login'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionLogin()
    {
        $loginForm = new LoginForm();

        if ($loginForm->load(Yii::$app->request->post()) && $loginForm->validate())
        {
            $currentUser = User::findOne(['login' => $loginForm->username]);

            if (isset($currentUser) &&
                Yii::$app->getSecurity()->validatePassword($loginForm->password, $currentUser->passhash) &&
                Yii::$app->user->login($currentUser)) {
                Yii::$app->response->redirect(['admin/complexes/index']);
                Yii::$app->end();
            }

            Yii::$app->session->addFlash('error', 'Не верный логин или пароль.');
        }

        return $this->render('login', ['model' => $loginForm]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        Yii::$app->response->redirect(['flats/index']);
        return;
    }
}