<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MasterYuran;

/**
 * MasterYuranSearch represents the model behind the search form about `app\models\MasterYuran`.
 */
class MasterYuranSearch extends MasterYuran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['yuran_bulanan', 'yatim', 'adik_beradik', 'oku', 'van', 'tuisyen', 'makan'], 'number'],
            [['tahun'], 'safe'],
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
        $query = MasterYuran::find();

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
            'yuran_bulanan' => $this->yuran_bulanan,
            'yatim' => $this->yatim,
            'adik_beradik' => $this->adik_beradik,
            'oku' => $this->oku,
            'van' => $this->van,
            'tuisyen' => $this->tuisyen,
            'makan' => $this->makan,
        ]);

        $query->andFilterWhere(['like', 'tahun', $this->tahun]);

        return $dataProvider;
    }
}
