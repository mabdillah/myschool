<?php
namespace app\api\v1\models;
use \yii\db\ActiveRecord;

class Pelajar extends ActiveRecord 
{
        /**
        * @inheritdoc
        */
        public static function tableName()
        {
            return 'pelajar';
        }

        /**
        * @inheritdoc
        */
        public static function primaryKey()
        {
        return ['id'];
        }

        /**
        * Define rules for validation
        */
        public function rules()
        {
        return [
                [['id', 'nama_pelajar'], 'required']
        ];
        }   
}