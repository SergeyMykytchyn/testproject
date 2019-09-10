<?php

namespace app\modules\admin\controllers;

use app\models\FlatsSearch;
use Yii;
use app\models\Houses;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class HousesController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'view', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionView($id)
    {
        $flatSearchModel = new FlatsSearch(['house_id' => $id]);
        $dataProvider = $flatSearchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'flatSearchModel' => $flatSearchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function formPost($model)
    {
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->house_id]);
        }
    }

    public function actionCreate($complex_id)
    {
        $model = new Houses(['complex_id' => $complex_id]);

        $this->formPost($model);

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $this->formPost($model);

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $HouseToDelete = $this->findModel($id);
        $complex_id = $HouseToDelete->complex_id;
        $HouseToDelete->delete();

        return $this->redirect(['complexes/view', 'id' => $complex_id]);
    }

    protected function findModel($id)
    {
        if (($model = Houses::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

