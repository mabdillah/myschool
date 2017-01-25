<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kelas".
 *
 * @property integer $id
 * @property string $nama_kelas
 */
class Kelas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kelas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['nama_kelas'], 'string', 'max' => 50],
            [['id_sesi','id_guru','tingkatan','nama_kelas'], 'integer'],
            [['id_sesi','nama_kelas','tingkatan'], 'required'],
			['id_sesi', 'validateSesikelas', 'skipOnEmpty' => false, 'on' => 'create'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_sesi' => 'Sesi',
            'nama_kelas' => 'Nama Kelas',
            'id_guru' => 'Guru Kelas',
            'tingkatan' => 'Darjah',
        ];
    }
	public function validateSesikelas($attribute, $params)
    {
		$data = Yii::$app->getDb()->createCommand("Select count(id) as jum FROM kelas WHERE id_sesi = '". $this->id_sesi ."' AND nama_kelas = '". $this->nama_kelas ."' AND tingkatan = '". $this->tingkatan ."' ;")->queryOne();
		
        if($data['jum']>0){
            $this->addError($attribute, 'Kelas : Kelas telah wujud');
        }
    }
    public function getKelasMp()
    {
        return $this->hasMany(KelasMp::className(), ['id_kelas' => 'id']);
    }
    public function getSesi(){
        return $this->hasOne(Sesi::className(), ['id' => 'id_sesi']);
    }
    public function getGuru(){
        return $this -> hasOne(Guru::className(), ['id' => 'id_guru']);
    }
    public function getRefKelas(){
        return $this ->hasOne(RefKelas::className(), ['id' => 'nama_kelas']);
    }
    public function getPelajarKelas()
    {
        return $this->hasMany(PelajarKelas::className(), ['id_kelas' => 'id']);
    }
}
