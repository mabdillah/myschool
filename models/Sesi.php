<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sesi".
 *
 * @property integer $id_sesi
 * @property string $tahun
 */
class Sesi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sesi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tahun','tarikh_mula','tarikh_tamat'], 'required'],
            [['tahun'], 'string', 'max' => 100],
            [['tahun'], 'unique'],
            [['tarikh_mula','tarikh_tamat'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_sesi' => 'Id Sesi',
            'tahun' => 'Tahun',
        ];
    }
    public function getExam()
    {
        return $this->hasMany(Exam::className(), ['id_sesi' => 'id_sesi']);
    }
    public function getKelasMp()
    {
        return $this->hasMany(KelasMp::className(), ['id_sesi' => 'id_sesi']);
    }

}
