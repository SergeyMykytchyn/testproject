<?php

namespace app\controllers;

use app\models\Cities;
use app\models\FilterForm;
use app\models\Flat_types;
use app\models\Flats;
use Yii;
use yii\web\Controller;

class FlatsController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    private static function cmpFlats($flat1, $flat2)
    {
        if($flat1['price'] != $flat2['price']) {
            return $flat1['price'] < $flat2['price'] ? -1 : 1;
        }

        $flat1Typical = $flat1['typical'];
        $flat2Typical = $flat2['typical'];

        if($flat1Typical != $flat2Typical) {
            return $flat1Typical ? -1 : 1;
        }
        return 0;
    }

    public function actionIndex()
    {
        $filterForm = new FilterForm();

        $cityNames = Cities::find()->select(['name', 'city_id'])->indexBy('city_id')->asArray()->column();
        $cityNames[0] = 'Не выбрано';
        $filterForm->city_id = '0';

        $flatTypes = Flat_types::find()->select(['name', 'flat_type_id'])->indexBy('flat_type_id')->asArray()->column();
        $flatTypes[0] = 'Не выбрано';
        $filterForm->flat_type_id = '0';

        $query = Flats::find()->select([
            'flats.flat_id',
            'complexes.name complex_name',
            'cities.name city_name',
            'houses.address',
            'flat_types.name flat_type',
            'flats.square',
            'flats.price'
            ])
            ->innerJoin('flat_types', 'flats.flat_type_id = flat_types.flat_type_id')
            ->innerJoin('houses', 'flats.house_id = houses.house_id')
            ->innerJoin('complexes', 'houses.complex_id = complexes.complex_id')
            ->innerJoin('cities', 'complexes.city_id = cities.city_id');

        if (Yii::$app->request->isPost) {

            $filterForm->load(Yii::$app->request->post());

            if ($filterForm->city_id != '0') {
                $query->andWhere(['cities.city_id' => $filterForm->city_id]);
            }

            if ($filterForm->flat_type_id != '0') {
                $query->andWhere(['flat_types.flat_type_id' => $filterForm->flat_type_id]);
            }
        }

        $data = $query->orderBy('flats.price')
                ->asArray()
                ->limit(50)
                ->all();

        for($i = 0; $i < count($data); $i++) {
            $data[$i]['typical'] = Flats::isFlatTypical($data[$i]['flat_id']);
        }

        usort($data, array($this, "cmpFlats"));

        return $this->render('index', [
            'cityList' => $cityNames,
            'flatTypesList' => $flatTypes,
            'filterForm' => $filterForm,
            'data' => $data
        ]);
    }
}
