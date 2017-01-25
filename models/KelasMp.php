<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kelas_mp".
 *
 * @property integer $id
 * @property integer $id_kelas
 * @property integer $id_guru
 * @property integer $id_matapelajaran
 */
class KelasMp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kelas_mp';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_sesi','id_kelas','id_guru','id_matapelajaran'], 'required'],
            [['id_sesi','id_guru'], 'integer'],
            [['id_matapelajaran'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_sesi'=>'Sesi',
            'id_kelas' => 'Kelas',
            'id_guru' => 'Guru',
            'id_matapelajaran' => 'Matapelajaran',

        ];
    }
    public function getSesi(){
        return $this -> hasOne(Sesi::className(), ['id_sesi' => 'id_sesi']);
    }
    public function getMatapelajaran(){
        return $this -> hasOne(Matapelajaran::className(), ['id_matapelajaran' => 'id_matapelajaran']);
    }
    public function getKelas(){
        return $this -> hasOne(Kelas::className(), ['id' => 'id_kelas']);
    }
    public function getGuru(){
        return $this -> hasOne(Guru::className(), ['id_guru' => 'id_guru']);
    }

    public function beforeSave($insert)
    {
//        if($this->id_kelas!=""){
//            $this->id_kelas = implode(',',$this->id_kelas);
//
//        }
        if($this->id_matapelajaran!=""){
            $this->id_matapelajaran = implode(',',$this->id_matapelajaran);

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
    public function getnama_matapelajaran()
    {

        $this->id_matapelajaran = explode(',', $this->id_matapelajaran);
        $nama = "";

        if ($this->id_matapelajaran != "") {
            $rows = Matapelajaran::find()->select(['id_matapelajaran', 'nama_matapelajaran','kod_matapelajaran'])->
            where(['id_matapelajaran' => $this->id_matapelajaran])->orderBy('id_matapelajaran')->all();

            if (count($rows) > 0) {

                foreach ($rows as $row) {
                    $nama .= "$row->kod_matapelajaran-$row->nama_matapelajaran<br>";
                }

            } else {
                echo "Tiada";
            }


        }
        return $nama;

    }

}
