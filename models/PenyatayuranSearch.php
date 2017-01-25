<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Penyatayuran;

/**
 * PenyatayuranSearch represents the model behind the search form about `app\models\Penyatayuran`.
 */
class PenyatayuranSearch extends Penyatayuran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_penyata', 'id_bulan'], 'integer'],
            [['yuran_belajar', 'yuran_makan', 'yuran_pengangkutan', 'yuran_tuisyen', 'yuran_tuisyenmakan', 'discount', 'jumlah'], 'number'],
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
        $query = Penyatayuran::find();

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
            'id_penyata' => $this->id_penyata,
            'id_bulan' => $this->id_bulan,
            'yuran_belajar' => $this->yuran_belajar,
            'yuran_makan' => $this->yuran_makan,
            'yuran_pengangkutan' => $this->yuran_pengangkutan,
            'yuran_tuisyen' => $this->yuran_tuisyen,
            'yuran_tuisyenmakan' => $this->yuran_tuisyenmakan,
            'discount' => $this->discount,
            'jumlah' => $this->jumlah,
        ]);

        return $dataProvider;
    }
}
