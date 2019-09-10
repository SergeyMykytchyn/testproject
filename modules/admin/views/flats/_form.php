<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Flats */
/* @var $form yii\widgets\ActiveForm */
/* @var $flatTypesList */

?>

<div class="flats-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'flat_type_id')->dropDownList($flatTypesList) ?>

    <?= $form->field($model, 'square')->textInput() ?>

    <?= $form->field($model, 'priceType')->radioList([0 => 'За кв.м', 1 => 'За всю квартиру']) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

