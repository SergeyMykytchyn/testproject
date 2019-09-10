<?php

namespace app\models;

use yii\db\ActiveRecord;

class Cities extends ActiveRecord
{
    public static function tableName ()
    {
        return "cities";
    }

    public function getComplexes()
    {
        return $this->hasMany(Complexes::class, ['city_id' => 'city_id']);
    }
}
