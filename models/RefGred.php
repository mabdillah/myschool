<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_gred".
 *
 * @property integer $id
 * @property string $gred
 * @property integer $min_mark
 * @property integer $max_mark
 */
class RefGred extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_gred';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gred', 'min_mark', 'max_mark'], 'required'],
            [['min_mark', 'max_mark'], 'integer'],
            [['gred'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gred' => 'Gred',
            'min_mark' => 'Min Mark',
            'max_mark' => 'Max Mark',
        ];
    }
}
