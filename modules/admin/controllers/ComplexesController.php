<?php

namespace app\modules\admin\controllers;

use app\models\Cities;
use app\models\HousesSearch;
use Yii;
use app\models\Complexes;
use app\models\ComplexesSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class ComplexesController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'index', 'view', 'delete'],
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

    public function actionIndex()
    {
        $searchModel = new ComplexesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $houseSearchModel = new HousesSearch(['complex_id' => $id]);
        $dataProvider = $houseSearchModel->search(Yii::$app->request->queryParams);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'houseSearchModel' => $houseSearchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function formPost($model)
    {
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->complex_id]);
        }

        return Cities::find()->select(['name', 'city_id'])->indexBy('city_id')->asArray()->column();
    }

    public function actionCreate()
    {
        $model = new Complexes();

        $cityNames = $this->formPost($model);

        return $this->render('create', [
            'model' => $model,
            'cityList' => $cityNames,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $cityNames = $this->formPost($model);

        return $this->render('update', [
            'model' => $model,
            'cityList' => $cityNames,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Complexes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}


