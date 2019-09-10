<?php

namespace app\models;

use Yii;
use yii\base\Model;

class FilterForm extends Model
{
    public $city_id;
    public $flat_type_id;

    public function attributeLabels()
    {
        return [
            'city_id' => 'Город',
            'flat_type_id' => 'Количество комнат'
        ];
    }

    public function rules()
    {
        return [
            [['city_id', 'flat_type_id'], 'safe'],
        ];
    }
}
