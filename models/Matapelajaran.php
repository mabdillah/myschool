<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "matapelajaran".
 *
 * @property integer $id
 * @property integer $id_matapelajaran
 * @property string $kod_matapelajaran
 * @property string $nama_matapelajaran
 */
class Matapelajaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'matapelajaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kod_matapelajaran', 'nama_matapelajaran'], 'required'],
            [['id_matapelajaran'], 'integer'],
            [['kod_matapelajaran'], 'string', 'max' => 10],
            [['nama_matapelajaran'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_matapelajaran' => 'Id Matapelajaran',
            'kod_matapelajaran' => 'Kod Matapelajaran',
            'nama_matapelajaran' => 'Nama Matapelajaran',
        ];
    }

}
