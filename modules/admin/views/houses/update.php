<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Houses */

$this->title = 'Редактировать дом по адресу: ' . $model->address;
$this->params['breadcrumbs'][] = ['label' => 'Все ЖК', 'url' => ['complexes/index']];
$this->params['breadcrumbs'][] = [
    'label' => $model->getComplexName(),
    'url' => ['complexes/view', 'id' => $model->complex_id]
];
$this->params['breadcrumbs'][] = ['label' => $model->address, 'url' => ['view', 'id' => $model->house_id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="houses-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

