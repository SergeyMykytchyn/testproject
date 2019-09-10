<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Complexes */
/* @var $cityList */

$this->title = 'Добавить ЖК';
$this->params['breadcrumbs'][] = ['label' => 'Все ЖК', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complexes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cityList' => $cityList,
    ]) ?>

</div>

