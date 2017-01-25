<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RefLokaliti;

/**
 * RefLokalitiSearch represents the model behind the search form about `app\models\RefLokaliti`.
 */
class RefLokalitiSearch extends RefLokaliti
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['REC_ID'], 'integer'],
            [['Kod_Negeri', 'Kod_Parlimen', 'Kod_DUN', 'Kod_Daerah', 'Kod_Lokaliti', 'Nama_Lokaliti'], 'safe'],
            [['harga_van','harga_van2'], 'number'],
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
        $query = RefLokaliti::find();

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
            'REC_ID' => $this->REC_ID,
            'harga_van' => $this->harga_van,
            'harga_van2' => $this->harga_van2,
        ]);

        $query->andFilterWhere(['like', 'Kod_Negeri', $this->Kod_Negeri])
            ->andFilterWhere(['like', 'Kod_Parlimen', $this->Kod_Parlimen])
            ->andFilterWhere(['like', 'Kod_DUN', $this->Kod_DUN])
            ->andFilterWhere(['like', 'Kod_Daerah', $this->Kod_Daerah])
            ->andFilterWhere(['like', 'Kod_Lokaliti', $this->Kod_Lokaliti])
            ->andFilterWhere(['like', 'Nama_Lokaliti', $this->Nama_Lokaliti]);

        return $dataProvider;
    }
}
