<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Matapelajaran;

/**
 * MatapelajaranSearch represents the model behind the search form about `app\models\Matapelajaran`.
 */
class MatapelajaranSearch extends Matapelajaran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_matapelajaran'], 'integer'],
            [['kod_matapelajaran', 'nama_matapelajaran'], 'safe'],
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
        $query = Matapelajaran::find();

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
            'id_matapelajaran' => $this->id_matapelajaran,
        ]);

        $query->andFilterWhere(['like', 'kod_matapelajaran', $this->kod_matapelajaran])
            ->andFilterWhere(['like', 'nama_matapelajaran', $this->nama_matapelajaran]);

        return $dataProvider;
    }
}
