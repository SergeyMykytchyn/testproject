<?php

namespace app\models;

use yii\db\ActiveRecord;

class Flat_types extends ActiveRecord
{
    public function rules()
    {
        return [
            ['flat_type_id', 'required'],
            ['name', 'required']
        ];
    }

//    public $attributes = [
//        'flat_type_id', 'name'
//    ];

    public static function tableName ()
    {
        return "flat_types";
    }

    public function getFlats()
    {
        return $this->hasMany(Flats::class, ['flat_type_id' => 'flat_type_id']);
    }
}
