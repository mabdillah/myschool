<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_lokaliti".
 *
 * @property integer $REC_ID
 * @property string $Kod_Negeri
 * @property string $Kod_Parlimen
 * @property string $Kod_DUN
 * @property string $Kod_Daerah
 * @property string $Kod_Lokaliti
 * @property string $Nama_Lokaliti
 * @property string $harga_van
 */
class RefLokaliti extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_lokaliti';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['harga_van','harga_van2'], 'number'],
            [['Kod_Negeri', 'Kod_DUN', 'Kod_Daerah'], 'string', 'max' => 2],
            [['Kod_Parlimen', 'Kod_Lokaliti'], 'string', 'max' => 3],
            [['Nama_Lokaliti'], 'string', 'max' => 60],
            [['Kod_Negeri', 'Kod_Parlimen', 'Kod_DUN', 'Kod_Daerah', 'Kod_Lokaliti'], 'unique', 'targetAttribute' => ['Kod_Negeri', 'Kod_Parlimen', 'Kod_DUN', 'Kod_Daerah', 'Kod_Lokaliti'], 'message' => 'The combination of Kod  Negeri, Kod  Parlimen, Kod  Dun, Kod  Daerah and Kod  Lokaliti has already been taken.'],
            [['Kod_Parlimen', 'Kod_DUN', 'Kod_Daerah', 'Kod_Lokaliti'], 'unique', 'targetAttribute' => ['Kod_Parlimen', 'Kod_DUN', 'Kod_Daerah', 'Kod_Lokaliti'], 'message' => 'The combination of Kod  Parlimen, Kod  Dun, Kod  Daerah and Kod  Lokaliti has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'REC_ID' => 'Rec  ID',
            'Kod_Negeri' => 'Kod  Negeri',
            'Kod_Parlimen' => 'Kod  Parlimen',
            'Kod_DUN' => 'Kod  Dun',
            'Kod_Daerah' => 'Kod  Daerah',
            'Kod_Lokaliti' => 'Kod  Lokaliti',
            'Nama_Lokaliti' => 'Nama  Lokaliti',
            'harga_van' => 'Harga Van Sehala',
            'harga_van2' => 'Harga Van Dua Hala',
        ];
    }
}
