<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bulan".
 *
 * @property integer $id_bulan
 * @property string $nama_bulan
 */
class Bulan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bulan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_bulan'], 'required'],
            [['nama_bulan'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_bulan' => 'Id Bulan',
            'nama_bulan' => 'Nama Bulan',
        ];
    }
}
