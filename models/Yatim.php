<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "yatim".
 *
 * @property integer $id_yatim
 * @property string $statusyatim
 */
class Yatim extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yatim';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['statusyatim'], 'required'],
            [['statusyatim'], 'string', 'max' => 11],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_yatim' => 'Id Yatim',
            'statusyatim' => 'Statusyatim',
        ];
    }
}
