<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Complexes;


class ComplexesSearch extends Complexes
{
    public $cityName = null;

    public function rules()
    {
        return [
            [['cityName'], 'safe'],
            [['name'], 'safe'],
            [['cityName'], 'string']
        ];
    }

//    /**
//     * {@inheritdoc}
//     */
//    public function scenarios()
//    {
//        // bypass scenarios() implementation in the parent class
//        return Model::scenarios();
//    }

    public function search($params)
    {
        $query = Complexes::find();

        $query->joinWith(['city']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes' => [
                'name',
                'cities.name'
            ]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'complexes.name', $this->name]);
        $query->andFilterWhere(['like', 'cities.name', $this->cityName]);
        return $dataProvider;
    }
}
