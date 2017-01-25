<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "oku".
 *
 * @property integer $id_oku
 * @property string $statusoku
 */
class Oku extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oku';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['statusoku'], 'required'],
            [['statusoku'], 'string', 'max' => 11],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_oku' => 'Id Oku',
            'statusoku' => 'Statusoku',
        ];
    }
}
