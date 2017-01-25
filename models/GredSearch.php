<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Gred;

/**
 * GredSearch represents the model behind the search form about `app\models\Gred`.
 */
class GredSearch extends Gred
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_gred', 'gred1', 'gred2'], 'integer'],
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
        $query = Gred::find();

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
            'id_gred' => $this->id_gred,
            'gred1' => $this->gred1,
            'gred2' => $this->gred2,
        ]);

        $query->andFilterWhere(['like', 'gred', $this->gred]);

        return $dataProvider;
    }
}
