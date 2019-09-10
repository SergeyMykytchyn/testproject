<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Flats */
/* @var $flatTypesList */

$this->title = 'Coздать';
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
<div class="flats-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'flatTypesList' => $flatTypesList
    ]) ?>

</div>

