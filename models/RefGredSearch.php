<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RefGred;

/**
 * RefGredSearch represents the model behind the search form about `app\models\RefGred`.
 */
class RefGredSearch extends RefGred
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'min_mark', 'max_mark'], 'integer'],
            [['gred'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = RefGred::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'min_mark' => $this->min_mark,
            'max_mark' => $this->max_mark,
        ]);

        $query->andFilterWhere(['like', 'gred', $this->gred]);

        return $dataProvider;
    }
}
