<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Flats */
/* @var $flatTypesList */
/* @var $complex */

$this->title = 'Добавить типичную квартиру';
$this->params['breadcrumbs'][] = ['label' => 'Все ЖК', 'url' => ['complexes/index']];
$this->params['breadcrumbs'][] = [
    'label' => $complex->name,
    'url' => ['complexes/view', 'id' => $complex->complex_id]
];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="flats-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'flatTypesList' => $flatTypesList
    ]) ?>

</div>
