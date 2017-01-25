<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_exam".
 *
 * @property integer $id
 * @property string $keterangan
 */
class RefExam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_exam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
