<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pelajar".
 *
 * @property integer $id
 * @property string $nama_pelajar
 * @property string $jantina
 * @property string $no_mykid
 * @property string $no_sijilLahir
 * @property integer $sesi
 * @property integer $id_pelajar_kelas
 * @property string $alamat
 * @property integer $poskod
 * @property string $daerah
 * @property string $negeri
 * @property string $nama_bapa
 * @property string $no_mykadBapa
 * @property string $pekerjaan_bapa
 * @property string $no_telBapa
 * @property string $nama_ibu
 * @property string $no_mykadIbu
 * @property string $pekerjaan_ibu
 * @property string $no_telIbu
 * @property string $status_yatim
 * @property string $status_OKU
 * @property string $warganegara
 * @property string $kaum
 * @property string $badan_beruniform
 * @property string $persatuan
 * @property string $sukan
 * @property string $catatan
 */
class Pelajar extends \yii\db\ActiveRecord
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
    public function rules()
    {
        return [
            [['alamat', 'nama_pelajar', 'poskod','jantina','no_mykid','no_sijilLahir','no_mykadBapa','no_mykadIbu','nama_bapa','nama_ibu','id_status'], 'required'],
            [['sesi', 'id_pelajar_kelas', 'poskod','rumah_sukan','id_status'], 'integer'],
            [['nama_pelajar', 'alamat','alamat2', 'badan_beruniform', 'persatuan', 'sukan', 'catatan'], 'string', 'max' => 255],
            [['jantina', 'negeri', 'no_telBapa', 'warganegara', 'kaum'], 'string', 'max' => 12],
            [['no_mykid', 'no_sijilLahir', 'daerah', 'no_mykadBapa', 'no_mykadIbu', 'no_telIbu'], 'string', 'max' => 25],
            [['nama_bapa', 'pekerjaan_bapa', 'nama_ibu', 'pekerjaan_ibu'], 'string', 'max' => 45],
            [['status_OKU', 'status_yatim'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_status'=>'Status',
            'id' => 'ID',
            'nama_pelajar' => 'Nama Pelajar',
            'jantina' => 'Jantina',
            'no_mykid' => 'No Mykid',
            'no_sijilLahir' => 'No Sijil Lahir',
            'sesi' => 'Sesi',
            'id_pelajar_kelas' => 'Id Pelajar Kelas',
            'alamat' => 'Alamat',
            'alamat2' => 'Alamat 2 (Kawasan Van)',
            'poskod' => 'Poskod',
            'daerah' => 'Daerah',
            'negeri' => 'Negeri',
            'nama_bapa' => 'Nama Bapa',
            'no_mykadBapa' => 'No Mykad Bapa',
            'pekerjaan_bapa' => 'Pekerjaan Bapa',
            'no_telBapa' => 'No Tel Bapa',
            'nama_ibu' => 'Nama Ibu',
            'no_mykadIbu' => 'No Mykad Ibu',
            'pekerjaan_ibu' => 'Pekerjaan Ibu',
            'no_telIbu' => 'No Tel Ibu',
            'status_yatim' => 'Anak Yatim',
            'status_OKU' => 'OKU',
            'warganegara' => 'Warganegara',
            'kaum' => 'Kaum',
            'badan_beruniform' => 'Badan Beruniform',
            'persatuan' => 'Persatuan',
            'sukan' => 'Sukan',
            'catatan' => 'Catatan',
            'id_sesi' => 'Sesi',
        ];
    }
   
    public function getKelasMp()
    {
        return $this->hasMany(KelasMp::className(), ['id_kelas' => 'id_pelajar_kelas']);
    }
    public function getTetapanYuranpelajar()
    {
        return $this->hasMany(TetapanYuranpelajar::className(), ['id_pelajar' => 'id']);
    }
    public function getStatus1()
    {
        return $this->hasOne(Status::className(), ['id_status' => 'id_status']);
    }
    public function getRefYatim()
    {
        return $this->hasOne(Yatim::className(), ['id_yatim' => 'status_yatim']);
    }
    public function getRefOku()
    {
        return $this->hasOne(Oku::className(), ['id_oku' => 'status_OKU']);
    }
    public function getRefAlamat2()
    {
        return $this->hasOne(RefLokaliti::className(), ['REC_ID' => 'alamat2']);
    }
    public function getRefKaum()
    {
        return $this->hasOne(RefKaum::className(), ['id' => 'kaum']);
    }
    public function getRefWarganegara()
    {
        return $this->hasOne(RefWarganegara::className(), ['id' => 'warganegara']);
    }
    public function getRefRumahsukan()
    {
        return $this->hasOne(RefRumahsukan::className(), ['id' => 'rumah_sukan']);
    }
    public function getRefPersatuan()
    {
        return $this->hasOne(RefPersatuan::className(), ['id' => 'persatuan']);
    }
    public function getRefBadanberuniform()
    {
        return $this->hasOne(RefBadanberuniform::className(), ['id' => 'persatuan']);
    }
    public function getPelajarInfo($param,$id)
    {
		$data = Yii::$app->getDb()->createCommand("Select $param FROM pelajar WHERE id=$id;")->queryOne(); 
        return $data[$param];
    }
    public function getListKelas($id)
    {
		$sql = "SELECT tingkatan,keterangan,tahun FROM `pelajar_kelas` inner join kelas on kelas.id=pelajar_kelas.id_kelas inner join ref_kelas on ref_kelas.id=kelas.nama_kelas inner join sesi on sesi.id=kelas.id_sesi WHERE id_pelajar= '$id' order by sesi.tahun ASC";
		$data = Yii::$app->getDb()->createCommand($sql)->queryAll();
		$txt = '';
		$txt .= '<table class="table table-bordered"><thead><tr><th>Darjah</th><th>Nama Kelas</th><th>Tahun</th></tr></thead><tbody>';
		foreach ($data as $datum) {
			
			$txt .= '<tr><td>'.$datum['tingkatan'].'</td><td>'.$datum['keterangan'].'</td><td>'.$datum['tahun'].'</td></tr>';
		}  
		$txt .= '</tbody></table>';
		return $txt;
    }
//    public function getnama_matapelajaran()
//    {
//
//        $this->id_matapelajaran = explode(',', $this->id_matapelajaran);
//        $nama = "";
//
//        if ($this->id_matapelajaran != "") {
//            $rows = Matapelajaran::find()->select(['id_matapelajaran', 'nama_matapelajaran'])->
//            where(['id_matapelajaran' => $this->id_matapelajaran])->orderBy('id_matapelajaran')->all();
//
//            if (count($rows) > 0) {
//
//                foreach ($rows as $row) {
//                    $nama .= "$row->id_matapelajaran-$row->nama_matapelajaran<br>";
//                }
//
//            } else {
//                echo "Tiada";
//            }
//
//
//        }
//        return $nama;
//
//    }
//    public function getSesi1()
//    {
//
//         $this->id_sesi = explode(',', $this->id_sesi);
//        $sesi = "";
//
//        if ($this->id_sesi != "") {
//            $rows = Sesi::find()->select(['id_sesi', 'tahun'])->
//            where(['id_sesi' => $this->id_sesi])->orderBy('id_sesi')->all();
//
//            if (count($rows) > 0) {
//
//                foreach ($rows as $row) {
//                    $sesi = "$row->tahun<br>";
//                }
//
//            } else {
//                echo "Tiada";
//            }
//
//
//        }
//        return $sesi;
//
//    }
//    public function getSesi()
//    {
//        return $this->hasOne(Sesi::className(), ['id_sesi' => 'id_sesi']);
//    }
//    public function beforeSave($insert)
//    {
//        if($this->id_pelajar_kelas!=""){
//            $this->id_pelajar_kelas = implode(',',$this->id_pelajar_kelas);
//        }
//        return parent::beforeSave($insert);
//    }
}
