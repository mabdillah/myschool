<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_poskod".
 *
 * @property integer $id
 * @property string $postcode
 * @property string $area
 * @property string $post_office
 * @property string $state_code
 * @property string $state_name
 */
class RefPoskod extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_poskod';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['postcode', 'area', 'post_office', 'state_code', 'state_name'], 'required'],
            [['postcode'], 'string', 'max' => 5],
            [['area'], 'string', 'max' => 70],
            [['post_office'], 'string', 'max' => 30],
            [['state_code'], 'string', 'max' => 3],
            [['state_name'], 'string', 'max' => 35],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'postcode' => 'Postcode',
            'area' => 'Area',
            'post_office' => 'Post Office',
            'state_code' => 'State Code',
            'state_name' => 'State Name',
        ];
    }
}
