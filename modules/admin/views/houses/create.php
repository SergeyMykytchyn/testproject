<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Houses */

$this->title = 'Добавить дом';
$this->params['breadcrumbs'][] = ['label' => 'Все ЖК', 'url' => ['complexes/index']];
$this->params['breadcrumbs'][] = [
        'label' => $model->getComplexName(),
        'url' => ['complexes/view', 'id' => $model->complex_id]
    ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="houses-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

