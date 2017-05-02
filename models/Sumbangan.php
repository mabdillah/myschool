<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sumbangan".
 *
 * @property integer $id
 * @property integer $id_jenissumbangan
 * @property string $nama
 * @property string $jumlah
 * @property string $tarikh_sumbangan
 * @property string $tarikh_dicipta
 * @property integer $user_id
 */
class Sumbangan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sumbangan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_jenissumbangan', 'user_id'], 'integer'],
            [['jumlah'], 'number'],
            [['tarikh_sumbangan', 'tarikh_dicipta','catatan'], 'safe'],
            [['nama'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_jenissumbangan' => 'Jenis Sumbangan',
            'nama' => 'Nama',
            'jumlah' => 'Jumlah',
            'tarikh_sumbangan' => 'Tarikh Sumbangan',
            'tarikh_dicipta' => 'Tarikh Dicipta',
            'user_id' => 'User ID',
        ];
    }
	public function getJenissumbangan()
	{
		return $this->hasOne(RefJenissumbangan::className(), ['id' => 'id_jenissumbangan']);
	}
}
