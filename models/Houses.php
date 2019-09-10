<?php

namespace app\models;

use yii\db\ActiveRecord;

class Houses extends ActiveRecord
{
    public function rules()
    {
        return [
            ['complex_id', 'required'],
            ['address', 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'address' => 'Адрес',
            'cityName' => 'Город',
            'complexName' => 'ЖК'
        ];
    }

    public static function tableName ()
    {
        return "houses";
    }

    public function getComplex()
    {
        return $this->hasOne(Complexes::class, ['complex_id' => 'complex_id']);
    }

    public function getComplexName()
    {
        return $this->complex->name ?? null;
    }
    public function getCityName()
    {
        return $this->complex->city->name ?? null;
    }

    public function getFlats()
    {
        return $this->hasMany(Flats::class, ['house_id' => 'house_id']);
    }
}
