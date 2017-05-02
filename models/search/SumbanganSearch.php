<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sumbangan;

/**
 * SumbanganSearch represents the model behind the search form about `app\models\Sumbangan`.
 */
class SumbanganSearch extends Sumbangan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_jenissumbangan', 'user_id'], 'integer'],
            [['nama', 'tarikh_sumbangan', 'tarikh_dicipta'], 'safe'],
            [['jumlah'], 'number'],
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
        $query = Sumbangan::find();

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
            'id_jenissumbangan' => $this->id_jenissumbangan,
            'jumlah' => $this->jumlah,
            'tarikh_sumbangan' => $this->tarikh_sumbangan,
            'tarikh_dicipta' => $this->tarikh_dicipta,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama]);

        return $dataProvider;
    }
}
