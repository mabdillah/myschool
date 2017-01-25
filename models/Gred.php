<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gred".
 *
 * @property integer $id_gred
 * @property string $gred
 * @property integer $gred1
 * @property integer $gred2
 */
class Gred extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gred';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gred', 'gred1', 'gred2'], 'required'],
            [['gred1', 'gred2'], 'integer'],
            [['gred'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_gred' => 'Id Gred',
            'gred' => 'Gred',
            'gred1' => 'Gred1',
            'gred2' => 'Gred2',
        ];
    }
}
