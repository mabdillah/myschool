<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "master_yuran".
 *
 * @property integer $id
 * @property string $yuran_bulanan
 * @property string $yatim
 * @property string $adik_beradik
 * @property string $oku
 * @property string $tahun
 * @property string $van
 * @property string $tuisyen
 * @property string $makan
 */
class MasterYuran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'master_yuran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['yuran_bulanan', 'yatim', 'adik_beradik', 'oku', 'van', 'tuisyen','adikberadik_3','makan_tuisyen', 'makan'], 'number'],
            [['yuran_bulanan','yatim','adik_beradik', 'adikberadik_3','makan_tuisyen', 'oku','tuisyen', 'makan','tahun'], 'required'],
			['tahun','unique'],
            [['tahun'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'yuran_bulanan' => 'Yuran Bulanan',
            'yatim' => 'Yatim (-)',
            'adik_beradik' => 'Adik Beradik (2 orang) (-)',
            'adikberadik_3' => 'Adik Beradik (> 2 orang) (-)',
            'makan_tuisyen' => 'Tuisyen + Makan (+)',
            'oku' => 'Oku (-)',
            'tahun' => 'Tahun',
            'van' => 'Van (+)',
            'tuisyen' => 'Tuisyen (+)',
            'makan' => 'Makan (+)',
        ];
    }
}
