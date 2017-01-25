<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "penyatayuran".
 *
 * @property integer $id_penyata
 * @property integer $id_bulan
 * @property double $yuran_belajar
 * @property double $yuran_makan
 * @property double $yuran_pengangkutan
 * @property double $yuran_tuisyen
 * @property double $yuran_tuisyenmakan
 * @property double $discount
 * @property double $jumlah
 */
class Penyatayuran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'penyatayuran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_kelas','id_sesi','darjah','id_bulan', 'yuran_belajar', 'yuran_makan', 'yuran_pengangkutan', 'yuran_tuisyen', 'yuran_tuisyenmakan', 'discount', 'jumlah'], 'required'],
            [['id_sesi','darjah','id_bulan'], 'integer'],
            [['id_kelas'], 'safe'],
            [['yuran_belajar', 'yuran_makan', 'yuran_pengangkutan', 'yuran_tuisyen', 'yuran_tuisyenmakan', 'discount', 'jumlah'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_penyata' => 'Id Penyata',
            'darjah' => 'Darjah',
            'id_kelas' => 'Kelas',
            'id_sesi' => 'Sesi',
            'id_bulan' => 'Bulan',
            'yuran_belajar' => 'Yuran Belajar',
            'yuran_makan' => 'Yuran Makan',
            'yuran_pengangkutan' => 'Yuran Pengangkutan',
            'yuran_tuisyen' => 'Yuran Tuisyen',
            'yuran_tuisyenmakan' => 'Yuran Tuisyenmakan',
            'discount' => 'Discount',
            'jumlah' => 'Jumlah',
        ];
    }
    public function getBulan(){
        return $this -> hasOne(Bulan::className(), ['id_bulan' => 'id_bulan']);
    }
    public function getSesi(){
        return $this -> hasOne(Sesi::className(), ['id_sesi' => 'id_sesi']);
    }
    public function beforeSave($insert)
    {
        if($this->id_kelas!=""){
            $this->id_kelas = implode(',',$this->id_kelas);

        }
        return parent::beforeSave($insert);
    }

    public function getnama_kelas()
    {

        $this->id_kelas = explode(',', $this->id_kelas);
        $nama = "";

        if ($this->id_kelas != "") {
            $rows = Kelas::find()->select(['id', 'nama_kelas'])->where(['id' => $this->id_kelas])->orderBy('id')->all();

            if (count($rows) > 0) {

                foreach ($rows as $row) {
                    $nama .= "$row->nama_kelas<br>";
                }

            } else {
                echo "Tiada";
            }


        }
        return $nama;

    }
}
