<?php

namespace app\models;

use yii\db\ActiveRecord;

class Complexes extends ActiveRecord
{
    public function attributeLabels()
    {
        return [
            'name' => 'Название ЖК',
            'cityName' => 'Город',
            'city_id' => 'Город',
        ];
    }

    public function rules()
    {
        return [
            ['city_id', 'required'],
            ['name', 'required'],
        ];
    }

    public static function tableName()
    {
        return "complexes";
    }

    public function getCity()
    {
        return $this->hasOne(Cities::class, ['city_id' => 'city_id']);
    }

    public function getCityName()
    {
        return $this->city->name ?? null;
    }

    public function getHouses()
    {
        return $this->hasMany(Houses::class, ['complex_id' => 'complex_id']);
    }
}
