<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Houses */
/* @var $flatSearchModel app\models\FlatsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->address;
$this->params['breadcrumbs'][] = ['label' => 'Все ЖК', 'url' => ['complexes/index']];
$this->params['breadcrumbs'][] = [
    'label' => $model->getComplexName(),
    'url' => ['complexes/view', 'id' => $model->complex_id]
];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="houses-view">

    <h1>Дом</h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->house_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->house_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить этот дом?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cityName',
            'complexName',
            'address',
        ],
    ]) ?>

</div>

<div class="flats-index">

    <h1>Квартиры</h1>

    <p>
        <?= Html::a('Добавить квартиру', ['flats/create', 'id' => $model->house_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $flatSearchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'square',
            'price',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                            'title' => Yii::t('app', 'Delete'),
                            'data' => [
                                'confirm' => 'Вы действительно хотите удалить эту квартиру?',
                            ],
                            'data-method' => 'POST',
                        ]);
                    },
                ],
                'controller' => 'flats'
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

