<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\YuranBulanan;

/**
 * YuranBulananSearch represents the model behind the search form about `app\models\YuranBulanan`.
 */
class YuranBulananSearch extends YuranBulanan
{
    /**
     * @inheritdoc
     */
	public $end_date;
    public function rules()
    {
        return [
            [['id', 'pelajar_id','flags_insert'], 'integer'],
            [['bulan_tahun', 'date_created','end_date','catatan2'], 'safe'],
            [['yuran_bulanan', 'van', 'tuisyen', 'makan', 'bayaran', 'baki'], 'number'],
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
        $query = YuranBulanan::find();

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
            'pelajar_id' => $this->pelajar_id,
            'yuran_bulanan' => $this->yuran_bulanan,
            'van' => $this->van,
            'tuisyen' => $this->tuisyen,
            'makan' => $this->makan,
            'bayaran' => $this->bayaran,
            'baki' => $this->baki,
            'flags_insert' => $this->flags_insert,
            //'date_created' => $this->date_created,
        ]);
		$query->andFilterWhere(
			['like', 'catatan2', $this->catatan2]
		);

        $query->andFilterWhere(['like', 'bulan_tahun', $this->bulan_tahun]);
		
		if($this->end_date != '' ){
			$query->andFilterWhere(['between', 'date_created', $this->date_created, $this->end_date]);
		}else{
			$query->andFilterWhere(['date_created' => $this->date_created,]);
		}

        return $dataProvider;
    }
}
