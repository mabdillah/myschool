<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "guru".
 *
 * @property integer $id
 * @property integer $id_guru
 * @property string $nama_guru
 */
class Guru extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'guru';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_guru','ic','no_tel'], 'required'],
            [['id_guru'], 'integer'],
            [['nama_guru'], 'string', 'max' => 100],
            [['no_tel'], 'string', 'max' => 20],
            [['ic'], 'string', 'max' => 14],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_guru' => 'Id Guru',
            'nama_guru' => 'Nama Guru',
            'no_tel' => 'No. Telefon',
            'ic' => 'No. Kad Pengenalan',
        ];
    }
    public function getKelas()
    {
        return $this->hasMany(Kelas::className(), ['id_guru' => 'id_guru']);
    }
    public function getKelasHtml($id,$tahun)
    {
		//AND sesi.tahun='".date('Y')."'
        $data = Yii::$app->getDb()->createCommand("SELECT kelas.id,keterangan,tingkatan,sesi.tahun,id_matapelajaran FROM `kelas_mp` inner join kelas on kelas.id=kelas_mp.id_kelas inner join ref_kelas on ref_kelas.id=kelas.nama_kelas inner join sesi on sesi.id = kelas.id_sesi where kelas_mp.id_guru='$id' AND id_matapelajaran != '' AND sesi.tahun='".$tahun."' ORDER BY tingkatan asc, keterangan asc;")->queryAll(); 
		$txt = '';
		$txt .= '<table class="table table-bordered"><thead><tr><th>Darjah</th><th>Nama Kelas</th><th>Tahun</th><th>Mata Pelajaran</th></tr></thead><tbody>';
		foreach ($data as $datum) {
			$txt .= '<tr><td>'.$datum['tingkatan'].'</td><td>'.$datum['keterangan'].'</td><td>'.$datum['tahun'].'</td><td>'. $this->getMp($datum['id_matapelajaran'],$datum['id']).'</td></tr>';
		}  
		$txt .= '</tbody></table>';
		return $txt;
    }
	public function getMp($matapel,$id_kelas)
    {
		$exmatapel = explode(',',$matapel);
		foreach($exmatapel as $value){
			$data = Yii::$app->getDb()->createCommand("SELECT nama_matapelajaran FROM `matapelajaran` WHERE id='$value';")->queryOne(); 
			// $this->getExam($value,$id_kelas,1)
			$q[] = "<table border='0' width='100%'><tr><td width='40%'>".yii\helpers\Html::a($data['nama_matapelajaran'],['exam/create','id_kelas'=>$id_kelas,'id_matapelajaran'=>$value]).'</td><td>
			<table class="table" width="100%">
				<tr>'.$this->getExam($value,$id_kelas).'</tr>
			</table>
			</td></tr></table>' ;
		}
		return implode('<br/>', $q);
	}
	public function getExam($idmp,$id_kelas){
		//$data2 = Yii::$app->getDb()->createCommand("SELECT id FROM `exam` WHERE id_matapelajaran='$idmp' AND id_kelas = '$id_kelas' AND description='$exam' ;")->queryOne(); 
		//$examdesc = [1=>'Awal Tahun',2=>'Pertengahan Tahun',3=>'Akhir Tahun'];
		$data2 = Yii::$app->getDb()->createCommand("SELECT exam.id,keterangan FROM `exam` INNER JOIN ref_exam ON ref_exam.id=exam.description WHERE id_matapelajaran='$idmp' AND id_kelas = '$id_kelas' order by exam.id ASC ;")->queryAll();
		$listexam = '';
		foreach ($data2 as $data2s) {
			$listexam .= "<td>".yii\helpers\Html::a($data2s['keterangan'],['exam/update','id'=>$data2s['id']])."</td>";
		}
		return $listexam;
	}
}
