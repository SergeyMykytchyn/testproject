<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Complexes */
/* @var $houseSearchModel app\models\HousesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Все ЖК', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="complexes-view">

    <h1>ЖК</h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->complex_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->complex_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить этот ЖК?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Добавить типовую квартиру', ['flats/create-typical', 'complex_id' => $model->complex_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cityName',
            'name',
        ],
    ]) ?>

</div>

<div class="houses-index">

    <h1>Дома</h1>

    <p>
        <?= Html::a('Добавить Дом', ['houses/create', 'complex_id' => $model->complex_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $houseSearchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'address',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                'title' => Yii::t('app', 'Delete'),
                                'data' => [
                                    'confirm' => 'Вы действительно хотите удалить этот дом?',
                                ],
                                'data-method' => 'POST',

                            ]);
                        },
                    ],
                    'controller' => 'houses',
                ],
    ]]); ?>

    <?php Pjax::end(); ?>

</div>

