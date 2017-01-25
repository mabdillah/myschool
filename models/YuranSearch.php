<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Yuran;

/**
 * YuranSearch represents the model behind the search form about `app\models\Yuran`.
 */
class YuranSearch extends Yuran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_yuran', 'id_pelajar', 'id_kelas', 'id_bulan'], 'integer'],
            [['yuran_pelajaran', 'baki_yuran_pelajaran', 'yuran_makan', 'baki_yuran_makan', 'yuran_pengangkutan', 'baki_yuran_pengangkutan', 'yuran_tuisyen', 'baki_yuran_tuisyen', 'yuran_tuisyen_makan', 'baki_yuran_tuisyen_makan'], 'number'],
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
        $query = Yuran::find();

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
            'id_yuran' => $this->id_yuran,
            'id_pelajar' => $this->id_pelajar,
            'id_kelas' => $this->id_kelas,
            'id_bulan' => $this->id_bulan,
            'yuran_pelajaran' => $this->yuran_pelajaran,
            'baki_yuran_pelajaran' => $this->baki_yuran_pelajaran,
            'yuran_makan' => $this->yuran_makan,
            'baki_yuran_makan' => $this->baki_yuran_makan,
            'yuran_pengangkutan' => $this->yuran_pengangkutan,
            'baki_yuran_pengangkutan' => $this->baki_yuran_pengangkutan,
            'yuran_tuisyen' => $this->yuran_tuisyen,
            'baki_yuran_tuisyen' => $this->baki_yuran_tuisyen,
            'yuran_tuisyen_makan' => $this->yuran_tuisyen_makan,
            'baki_yuran_tuisyen_makan' => $this->baki_yuran_tuisyen_makan,
        ]);

        return $dataProvider;
    }
}
