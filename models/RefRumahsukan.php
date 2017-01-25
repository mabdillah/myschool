<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_rumahsukan".
 *
 * @property integer $id
 * @property string $keterangan
 */
class RefRumahsukan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_rumahsukan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keterangan'], 'string', 'max' => 255],
            [['keterangan'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'keterangan' => 'Keterangan',
        ];
    }
}
