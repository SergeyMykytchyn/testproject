<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Flats */

$this->title = $model->flatTypeName;

$this->params['breadcrumbs'][] = ['label' => 'Все ЖК', 'url' => ['complexes/index']];
$this->params['breadcrumbs'][] = [
    'label' => $model->getComplexName(),
    'url' => ['complexes/view', 'id' => $model->house->complex->complex_id]
];
$this->params['breadcrumbs'][] = [
        'label' => $model->house->address,
        'url' => ['houses/view', 'id' => $model->house_id]
];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="flats-view">

    <h1>Квартира</h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->flat_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->flat_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить эту квартиру?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'complexCity',
            'complexName',
            'houseAddress',
            'flatTypeName',
            'square',
            'price',
        ],
    ]) ?>

</div>

