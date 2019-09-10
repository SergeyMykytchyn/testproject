<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Complexes */
/* @var $cityList */

$this->title = 'Редактировать ЖК: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Все ЖК', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->complex_id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="complexes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cityList' => $cityList,
    ]) ?>

</div>

