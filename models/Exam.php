<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "exam".
 *
 * @property integer $id
 * @property string $description
 * @property integer $id_kelas
 * @property integer $id_matapelajaran
 */
class Exam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_kelas', 'id_matapelajaran'], 'integer'],
            [['description','tahun'], 'string', 'max' => 50],
			['description', 'validateExam', 'skipOnEmpty' => false, 'on' => 'create'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Peperiksaan',
            'id_kelas' => 'Kelas',
            'id_matapelajaran' => 'Mata Pelajaran',
        ];
    }
	public function validateExam($attribute, $params)
    {
		$data = Yii::$app->getDb()->createCommand("Select count(id) as jum FROM exam WHERE description = '". $this->description ."' AND id_kelas = '". $this->id_kelas ."' AND id_matapelajaran = '". $this->id_matapelajaran ."' ;")->queryOne();
		
        if($data['jum']>0){
            $this->addError($attribute, 'Peperiksaan ini telah wujud');
        }
    }
	
    public function getMarkah()
    {
        return $this->hasMany(Markah::className(), ['id_exam' => 'id']);
    }
}
