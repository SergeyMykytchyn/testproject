<?php

namespace app\modules\admin\controllers;

use app\models\Complexes;
use app\models\Flat_types;
use Yii;
use app\models\Flats;
use app\models\FlatsSearch;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class FlatsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'view', 'delete', 'create-typical'],
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
        $searchModel = new FlatsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreateTypical($complex_id)
    {
        if (Yii::$app->request->isPost) {
            $complex = Complexes::findOne(['complex_id' => $complex_id]);

            if (!isset($complex)) {
                throw new NotFoundHttpException("ЖК не найден");
            }

            foreach ($complex->houses as $house){
                $newFlat = new Flats(array_merge(Yii::$app->request->post('Flats'), ['house_id' => $house->house_id]));
                if ($newFlat->priceType == '0') {
                    $newFlat->price = $newFlat->price * $newFlat->square;
                }
                if(!$newFlat->save())
                    throw new BadRequestHttpException('Data s not valid');
            }

            Yii::$app->session->addFlash('success', 'Квартиры успешно добавлены во все дома данного ЖК');
            return Yii::$app->response->redirect(['/admin/complexes/view', 'id' => $complex_id]);
        }
        $complex = Complexes::findOne(['complex_id' => $complex_id]);
        $model = new Flats();
        $model->load(Yii::$app->request->post());
        $flatTypes = Flat_types::find()->select(['name', 'flat_type_id'])->indexBy('flat_type_id')->asArray()->column();

        return $this->render('create-typical', [
            'model' => $model,
            'flatTypesList' => $flatTypes,
            'complex' => $complex
        ]);
    }

    public function formPost($model)
    {
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->priceType == '0') {
                $model->price = $model->price * $model->square;
            }
            if(!$model->save())
                throw new BadRequestHttpException('Data is not valid');
            return $this->redirect(['view', 'id' => $model->flat_id]);
        }
        return Flat_types::find()->select(['name', 'flat_type_id'])->indexBy('flat_type_id')->asArray()->column();
    }

    public function actionCreate($id)
    {
        $model = new Flats(['house_id' => $id]);

        $flatTypes = $this->formPost($model);

        return $this->render('create', [
            'model' => $model,
            'flatTypesList' => $flatTypes
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $flatTypes = $this->formPost($model);

        return $this->render('update', [
            'model' => $model,
            'flatTypesList' => $flatTypes
        ]);
    }

    public function actionDelete($id)
    {
        $FlatToDelete = $this->findModel($id);
        $house_id = $FlatToDelete->house_id;
        $FlatToDelete->delete();

        return $this->redirect(['houses/view', 'id' => $house_id]);
    }

    protected function findModel($id)
    {
        if (($model = Flats::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
