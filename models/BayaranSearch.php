<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Bayaran;

/**
 * BayaranSearch represents the model behind the search form about `app\models\Bayaran`.
 */
class BayaranSearch extends Bayaran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_bayaran', 'id_pelajar', 'id_kelas', 'id_bulan'], 'integer'],
            [['tarikh'], 'safe'],
            [['duit_perludibayar', 'duit_terima', 'baki'], 'number'],
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
        $query = Bayaran::find();

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
            'id_bayaran' => $this->id_bayaran,
            'id_pelajar' => $this->id_pelajar,
            'id_kelas' => $this->id_kelas,
            'id_bulan' => $this->id_bulan,
            'duit_perludibayar' => $this->duit_perludibayar,
            'duit_terima' => $this->duit_terima,
            'baki' => $this->baki,
        ]);

        $query->andFilterWhere(['like', 'tarikh', $this->tarikh]);

        return $dataProvider;
    }
}
