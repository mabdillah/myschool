<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "yuran".
 *
 * @property integer $id_yuran
 * @property integer $id_pelajar
 * @property integer $id_kelas
 * @property integer $id_bulan
 * @property double $yuran_pelajaran
 * @property double $baki_yuran_pelajaran
 * @property double $yuran_makan
 * @property double $baki_yuran_makan
 * @property double $yuran_pengangkutan
 * @property double $baki_yuran_pengangkutan
 * @property double $yuran_tuisyen
 * @property double $baki_yuran_tuisyen
 * @property double $yuran_tuisyen_makan
 * @property double $baki_yuran_tuisyen_makan
 */
class Yuran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yuran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pelajar','darjah','id_sesi',   'id_kelas', 'id_bulan', 'yuran_pelajaran', 'baki_yuran_pelajaran', 'yuran_makan', 'baki_yuran_makan', 'yuran_pengangkutan', 'baki_yuran_pengangkutan', 'yuran_tuisyen', 'baki_yuran_tuisyen', 'yuran_tuisyen_makan', 'baki_yuran_tuisyen_makan'], 'required'],
            [['id_pelajar', 'darjah','id_sesi', 'id_bulan'], 'integer'],
            [['id_kelas'], 'safe'],
            [['jumlah_yuran','discount','yuran_pelajaran', 'baki_yuran_pelajaran', 'yuran_makan', 'baki_yuran_makan', 'yuran_pengangkutan', 'baki_yuran_pengangkutan', 'yuran_tuisyen', 'baki_yuran_tuisyen', 'yuran_tuisyen_makan', 'baki_yuran_tuisyen_makan'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_yuran' => 'Id Yuran',
            'id_pelajar' => 'Id Pelajar',
            'darjah' => 'Darjah',
            'id_kelas' => 'Kelas',
            'id_sesi' => 'Sesi',
            'id_bulan' => 'Bulan',
            'yuran_pelajaran' => 'Yuran Pelajaran',
            'baki_yuran_pelajaran' => 'Baki Yuran Pelajaran',
            'yuran_makan' => 'Yuran Makan',
            'baki_yuran_makan' => 'Baki Yuran Makan',
            'yuran_pengangkutan' => 'Yuran Pengangkutan',
            'baki_yuran_pengangkutan' => 'Baki Yuran Pengangkutan',
            'yuran_tuisyen' => 'Yuran Tuisyen',
            'baki_yuran_tuisyen' => 'Baki Yuran Tuisyen',
            'yuran_tuisyen_makan' => 'Yuran Tuisyen Makan',
            'baki_yuran_tuisyen_makan' => 'Baki Yuran Tuisyen Makan',
            'discount' => 'Discount',
            'jumlah_yuran' => 'Jumlah Yuran',
        ];
    }
    public function getBulan(){
        return $this -> hasOne(Bulan::className(), ['id_bulan' => 'id_bulan']);
    }
}
