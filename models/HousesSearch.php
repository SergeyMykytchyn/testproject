<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Houses;

/**
 * HousesSearch represents the model behind the search form of `app\models\Houses`.
 */
class HousesSearch extends Houses
{
    public function rules()
    {
        return [
            [['house_id', 'complex_id'], 'integer'],
            [['address'], 'safe'],
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
        $query = Houses::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['complex_id' => $this->complex_id]);
        $query->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }
}
