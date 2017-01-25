<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bayaran".
 *
 * @property integer $id_bayaran
 * @property integer $id_pelajar
 * @property integer $id_kelas
 * @property integer $id_bulan
 * @property string $tarikh
 * @property double $duit_perludibayar
 * @property double $duit_terima
 * @property double $baki
 */
class Bayaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bayaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pelajar', 'id_kelas', 'id_bulan', 'tarikh', 'duit_perludibayar', 'duit_terima', 'baki'], 'required'],
            [['id_pelajar', 'id_kelas', 'id_bulan'], 'integer'],
            [['duit_perludibayar', 'duit_terima', 'baki'], 'number'],
            [['tarikh'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_bayaran' => 'Id Bayaran',
            'id_pelajar' => 'Id Pelajar',
            'id_kelas' => 'Id Kelas',
            'id_bulan' => 'Id Bulan',
            'tarikh' => 'Tarikh',
            'duit_perludibayar' => 'Duit Perludibayar',
            'duit_terima' => 'Duit Terima',
            'baki' => 'Baki',
        ];
    }
    public function getBulan(){
        return $this -> hasOne(Bulan::className(), ['id_bulan' => 'id_bulan']);
    }
}
