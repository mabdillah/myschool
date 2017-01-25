<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tetapan_yuranpelajar".
 *
 * @property integer $id
 * @property integer $id_pelajar
 * @property integer $bulan
 * @property string $bulanan
 * @property integer $tahun
 * @property string $makan
 * @property string $van
 * @property string $tuisyen
 * @property integer $flags
 */
class TetapanYuranpelajar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tetapan_yuranpelajar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pelajar', 'bulan', 'tahun', 'flags'], 'integer'],
            [['bulanan', 'makan', 'van', 'tuisyen'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_pelajar' => 'Id Pelajar',
            'bulan' => 'Bulan',
            'bulanan' => 'Bulanan',
            'tahun' => 'Tahun',
            'makan' => 'Makan',
            'van' => 'Van',
            'tuisyen' => 'Tuisyen',
            'flags' => 'Flags',
        ];
    }
}
