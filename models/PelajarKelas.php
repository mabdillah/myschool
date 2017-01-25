<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pelajar_kelas".
 *
 * @property integer $id
 * @property integer $id_pelajar
 * @property integer $id_kelas
 */
class PelajarKelas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pelajar_kelas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_kelas'], 'required'],
            [['id_pelajar', 'id_kelas'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_pelajar' => 'Pelajar',
            'id_kelas' => 'Kelas',
            'id_sesi' => 'Sesi',
        ];
    }
	
    public function getKelas(){
        return $this->hasOne(Kelas::className(), ['id' => 'id_kelas']);
    }
    public function getPelajar(){
        return $this->hasOne(Pelajar::className(), ['id' => 'id_pelajar']);
    }
}
