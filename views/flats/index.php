<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Flats */
/* @var $form yii\widgets\ActiveForm */
/* @var $cityList */
/* @var $flatTypesList */
/* @var $filterForm*/
/* @var $data */

function typeColumn($s)
{
    return "<td>".$s."</td>";
}

$this->title = 'Главная';
?>

<div>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($filterForm, 'city_id')->dropDownList($cityList) ?>

    <?= $form->field($filterForm, 'flat_type_id')->dropDownList($flatTypesList) ?>

    <div>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<table class = "table table-striped">
    <tr>
        <td>ЖК</td>
        <td>Город</td>
        <td>Адрес</td>
        <td>Количество комнат</td>
        <td>Площадь</td>
        <td>Цена</td>
    </tr>
    <?php
        foreach($data as $row) {
            echo "<tr>".
                    typeColumn($row['complex_name']).typeColumn($row['city_name']).typeColumn($row['address']).
                    typeColumn($row['flat_type']).typeColumn($row['square']."  кв.м").typeColumn($row['price']." грн") .
                 "</tr>";
        }
    ?>
</table>

