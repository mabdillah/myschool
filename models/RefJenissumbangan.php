<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_jenissumbangan".
 *
 * @property integer $id
 * @property string $keterangan
 */
class RefJenissumbangan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_jenissumbangan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keterangan'], 'required'],
            [['keterangan'], 'string', 'max' => 255],
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
