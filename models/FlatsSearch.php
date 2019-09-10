<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Flats;


class FlatsSearch extends Flats
{
    public $name = null;

    public function rules()
    {
        return [
            [['flat_id', 'house_id', 'flat_type_id', 'price'], 'integer'],
            [['square'], 'number'],
            [['name'], 'string']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Flats::find();

        $query->joinwith(['flatType']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes' => [
                'name',
                'square',
                'price'
            ]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'flat_id' => $this->flat_id,
            'house_id' => $this->house_id,
            'flat_type_id' => $this->flat_type_id,
            'square' => $this->square,
            'price' => $this->price,
            'name' => $this->name
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'square', $this->square]);
        $query->andFilterWhere(['like', 'price', $this->price]);

        return $dataProvider;
    }
}
