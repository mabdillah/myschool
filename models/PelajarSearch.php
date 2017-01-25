<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pelajar;

/**
 * PelajarSearch represents the model behind the search form about `app\models\Pelajar`.
 */
class PelajarSearch extends Pelajar
{
	public $id_kelas;
	public $id_sesi;
	public $nama_kelas;
	public $tingkatan;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sesi', 'id_pelajar_kelas', 'poskod','id_status','rumah_sukan','id_sesi','nama_kelas','tingkatan','id_kelas'], 'integer'],
            [['nama_pelajar', 'jantina', 'no_mykid', 'no_sijilLahir', 'alamat', 'daerah', 'negeri', 'nama_bapa', 'no_mykadBapa', 'pekerjaan_bapa', 'no_telBapa', 'nama_ibu', 'no_mykadIbu', 'pekerjaan_ibu', 'no_telIbu', 'status_yatim', 'status_OKU', 'warganegara', 'kaum', 'badan_beruniform', 'persatuan', 'sukan', 'catatan'], 'safe'],
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
        $query = Pelajar::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => [ 'pageSize' => 40 ],
			'sort' => ['defaultOrder' =>[ 'nama_pelajar' => SORT_ASC ]],
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
            'sesi' => $this->sesi,
            'id_pelajar_kelas' => $this->id_pelajar_kelas,
            'poskod' => $this->poskod,
            'id_status' => $this->id_status,
            'rumah_sukan' => $this->rumah_sukan,
        ]);

        $query->andFilterWhere(['like', 'nama_pelajar', $this->nama_pelajar])
            ->andFilterWhere(['like', 'jantina', $this->jantina])
            ->andFilterWhere(['like', 'no_mykid', $this->no_mykid])
            ->andFilterWhere(['like', 'no_sijilLahir', $this->no_sijilLahir])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'daerah', $this->daerah])
            ->andFilterWhere(['like', 'negeri', $this->negeri])
            ->andFilterWhere(['like', 'nama_bapa', $this->nama_bapa])
            ->andFilterWhere(['like', 'no_mykadBapa', $this->no_mykadBapa])
            ->andFilterWhere(['like', 'pekerjaan_bapa', $this->pekerjaan_bapa])
            ->andFilterWhere(['like', 'no_telBapa', $this->no_telBapa])
            ->andFilterWhere(['like', 'nama_ibu', $this->nama_ibu])
            ->andFilterWhere(['like', 'no_mykadIbu', $this->no_mykadIbu])
            ->andFilterWhere(['like', 'pekerjaan_ibu', $this->pekerjaan_ibu])
            ->andFilterWhere(['like', 'no_telIbu', $this->no_telIbu])
            ->andFilterWhere(['like', 'status_yatim', $this->status_yatim])
            ->andFilterWhere(['like', 'status_OKU', $this->status_OKU])
            ->andFilterWhere(['like', 'warganegara', $this->warganegara])
            ->andFilterWhere(['like', 'kaum', $this->kaum])
            ->andFilterWhere(['like', 'badan_beruniform', $this->badan_beruniform])
            ->andFilterWhere(['like', 'persatuan', $this->persatuan])
            ->andFilterWhere(['like', 'sukan', $this->sukan])
            ->andFilterWhere(['like', 'catatan', $this->catatan]);

        return $dataProvider;
    }
}
