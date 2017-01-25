<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_warganegara".
 *
 * @property integer $id
 * @property string $keterangan
 */
class RefWarganegara extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_warganegara';
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
