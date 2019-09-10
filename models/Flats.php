<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Flats extends ActiveRecord
{
    public $priceType = '0';

    public function rules()
    {
        return [
            ['house_id', 'required'],
            ['flat_type_id', 'required'],
            ['square', 'required'],
            ['price', 'required'],
            ['square', 'double'],
            ['price', 'integer'],
            ['priceType', 'integer'],
            ['name', 'string']
        ];
    }

    public function attributeLabels()
    {
        return [
            'houseAddress' => 'Адрес дома',
            'flatTypeName' => 'Количество комнат',
            'name' => 'Количество комнат',
            'complexName' => 'ЖК',
            'complexCity' => 'Город',
            'square' => 'Общая площадь в  кв. м',
            'price' => 'Цена',
            'flat_type_id' => 'Количество комнат',
            'priceType' => 'Цена указана: '
        ];
    }

    public static function tableName ()
    {
        return "flats";
    }

    public function getHouse()
    {
        return $this->hasOne(Houses::class, ['house_id' => 'house_id']);
    }

    public function getFlatType()
    {
        return $this->hasOne(Flat_types::class, ['flat_type_id' => 'flat_type_id']);
    }

    public function getFlatTypeName()
    {
        return $this->flatType->name ?? null;
    }

    public function getName()
    {
        return $this->flatType->name ?? null;
    }

    public function getHouseAddress()
    {
        return $this->house->address ?? null;
    }

    public function getComplexName()
    {
        return $this->house->complexName ?? null;
    }

    public function getComplexCity()
    {
        return $this->house->complex->city->name ?? null;
    }

    public static function isFlatTypical($flat_id)
    {
        $flat = Flats::findOne($flat_id);
        $complex_id = $flat->house->complex->complex_id;

        $count = Yii::$app->db->createCommand(
            'SELECT COUNT(*) FROM Houses WHERE Houses.complex_id = :complex_id AND
                    NOT EXISTS(SELECT * FROM Flats WHERE Flats.house_id = Houses.house_id AND
                        Flats.flat_type_id = :flat_type_id AND Flats.square = :square AND Flats.price = :price)',
                [':complex_id' => $complex_id, ':flat_type_id' => $flat->flat_type_id, ':square' => $flat->square, ':price' => $flat->price])
                ->queryScalar();

        if ($count == '0')
            return true;
        return false;
    }
}
