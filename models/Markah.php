<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "markah".
 *
 * @property integer $id
 * @property integer $id_pelajar
 * @property integer $id_exam
 * @property string $markah1
 * @property string $markah2
 * @property string $jumlah
 * @property string $gred
 */
class Markah extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	 public $jumMarkah;
    public static function tableName()
    {
        return 'markah';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pelajar', 'id_exam', 'markah1', 'markah2', 'jumlah', 'gred'], 'required'],
            [['id_pelajar', 'id_exam'], 'integer'],
            [['markah1', 'markah2', 'jumlah', 'gred'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_pelajar' => 'Nama Pelajar',
            'id_exam' => 'Id Exam',
            'markah1' => 'Markah1',
            'markah2' => 'Markah2',
            'jumlah' => 'Jumlah',
            'gred' => 'Gred',
            'jumMarkah' => 'Jumlah Markah',
        ];
    }
	
    public function getPelajar()
    {
        return $this->hasOne(Pelajar::className(), ['id' => 'id_pelajar']);
    }
    public function getExam()
    {
        return $this->hasOne(Exam::className(), ['id' => 'id_exam']);
    }
}
