<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Markah;

/**
 * MarkahSearch represents the model behind the search form about `app\models\Markah`.
 */
class MarkahSearch extends Markah
{
    /**
     * @inheritdoc
     */
	 public $tahun;
	 public $peperiksaan;
    public function rules()
    {
        return [
            [['id', 'id_pelajar', 'id_exam','peperiksaan'], 'integer'],
            [['markah1', 'markah2', 'jumlah', 'gred','tahun'], 'safe'],
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
        $query = Markah::find()
		->select('id_pelajar, SUM(jumlah) as jumMarkah')
        ->groupBy('id_pelajar')
		->orderBy('sum(jumlah) DESC');
		
		$query->joinWith(['exam']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => [ 'pageSize' => 40 ],
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
            'id_pelajar' => $this->id_pelajar,
            'id_exam' => $this->id_exam,
            'exam.tahun' => $this->tahun,
            'exam.description' => $this->peperiksaan,
        ]);
		

        $query->andFilterWhere(['like', 'markah1', $this->markah1])
            ->andFilterWhere(['like', 'markah2', $this->markah2])
            ->andFilterWhere(['like', 'jumlah', $this->jumlah])
            ->andFilterWhere(['like', 'gred', $this->gred]);

        return $dataProvider;
    }
}
