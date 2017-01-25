<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\KelasMp;

/**
 * KelasMpSearch represents the model behind the search form about `app\models\KelasMp`.
 */
class KelasMpSearch extends KelasMp
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_kelas', 'id_guru', 'id_matapelajaran'], 'integer'],
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
        $query = KelasMp::find();

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
            'id_kelas' => $this->id_kelas,
            'id_guru' => $this->id_guru,
            'id_matapelajaran' => $this->id_matapelajaran,
        ]);

        return $dataProvider;
    }
    public function getKelas(){
        return $this -> hasOne(Kelas::className(), ['id' => 'id_kelas']);
    }
}
