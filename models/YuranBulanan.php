<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "yuran_bulanan".
 *
 * @property integer $id
 * @property integer $pelajar_id
 * @property string $bulan_tahun
 * @property string $yuran_bulanan
 * @property string $van
 * @property string $tuisyen
 * @property string $makan
 * @property string $bayaran
 * @property string $baki
 * @property string $date_created
 */
class YuranBulanan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	public $end_date;
    public static function tableName()
    {
        return 'yuran_bulanan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pelajar_id','bayaran'], 'required'],
            [['pelajar_id','bayar_tambah'], 'integer'],
            [['yuran_bulanan', 'van', 'tuisyen', 'makan','_van', '_tuisyen', '_makan', 'bayaran', 'baki','yuran_bulanan2'], 'safe'],
            [['date_created','catatan','catatan2','bulan','tahun','end_date'], 'safe'],
            //[['bulan_tahun'], 'match', 'pattern' => '/^([0-1]{1})([0-9]{1})\/2([0-9]{3})$/','message'=>'Format bulan dan tahun salah. Cth: 01/2016 '],
        ];
    }
	public function getPelajar(){
        return $this -> hasOne(Pelajar::className(), ['id' => 'pelajar_id']);
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pelajar_id' => 'Pelajar ID',
            'bulan_tahun' => 'Bayaran Bulan',
            'yuran_bulanan' => 'Yuran Bulanan',
            'yuran_bulanan2' => 'Yuran Perlu Dibayar',
            'van' => 'Van',
            'tuisyen' => 'Tuisyen',
            'makan' => 'Makan',
            '_van' => 'Van',
            '_tuisyen' => 'Tuisyen',
            '_makan' => 'Makan',
            'bayaran' => 'Bayaran',
            'baki' => 'Baki',
            'catatan' => 'Catatan',
            'catatan2' => 'Catatan',
            'date_created' => 'Tarikh',
            'tarikh_dicipta' => 'Tarikh',
            'end_date' => 'Sehingga',
        ];
    }
	public function findSesi($tahun){
		$data = Yii::$app->getDb()->createCommand("SELECT tarikh_mula,tarikh_tamat FROM `sesi` WHERE tahun='".$tahun."' ")->queryOne();
		return array("tarikh_mula"=>$data['tarikh_mula'],"tarikh_tamat"=>$data['tarikh_tamat']);
	}
	public function findyuran($tahun){
		$data = Yii::$app->getDb()->createCommand("SELECT yatim,adik_beradik,oku,yuran_bulanan FROM `master_yuran` WHERE tahun='".$tahun."' ")->queryOne();
		return array("yuran_bulanan"=>$data['yuran_bulanan'],"yatim"=>$data['yatim'],"adik_beradik"=>$data['adik_beradik'],"oku"=>$data['oku']);
	}
	public function findpelajar($param,$id){
		$data = Yii::$app->getDb()->createCommand("SELECT $param FROM `pelajar` WHERE id='".$id."' ")->queryOne();
		return $data[$param];
	}
	public function findadikberadik($mykadbapa){
		$data = Yii::$app->getDb()->createCommand("SELECT no_mykid from pelajar p1 where id in (select id from pelajar p2 where no_mykadBapa = '".$mykadbapa."') and id_status=1 GROUP BY no_mykadBapa having COUNT(*)>1")->queryOne();
		return $data["no_mykid"];
	}
	public function findadik($mykadbapa){
		$data = Yii::$app->getDb()->createCommand("SELECT id FROM pelajar WHERE no_mykadBapa = '".$mykadbapa."' AND id_status=1 ORDER BY  CAST(substring(no_mykid,1,2) AS UNSIGNED) DESC LIMIT 1")->queryOne();
		return $data["id"];
	}
	public function findbiladikberadik($mykadbapa){
		$data = Yii::$app->getDb()->createCommand("SELECT count(*) bil from pelajar WHERE no_mykadBapa = '".$mykadbapa."' AND id_status=1")->queryOne();
		return $data["bil"] > 1 ? $data["bil"] : '0';
	}
	public function findtolakyuran($id){
		$data = Yii::$app->getDb()->createCommand("SELECT status_yatim,status_OKU from pelajar WHERE id='".$id."' ")->queryOne();
		return array("status_yatim"=>$data['status_yatim'],"status_OKU"=>$data['status_OKU']);
	}
	public function getYuranvan($id,$param){
		$data = Yii::$app->getDb()->createCommand("SELECT $param from ref_lokaliti WHERE REC_ID= (SELECT alamat2 from pelajar where id= '".$id."') ")->queryOne();
		return isset($data[$param]) ? $data[$param] : 0 ;
	}
	public  function beforeSave($insert)
    {
		$expbulthn = explode('/',$this->bulan_tahun);
		$this->bulan = $expbulthn[0];
		//$this->tahun = $expbulthn[1];
		$this->catatan = $this->bayaran > 0 ? 'Bayaran Bulan: ' : 'Tambahan Yuran: ';
		//if($this->bayaran > 0 && ($this->_van == 1 || $this->_tuisyen == 1 || $this->_makan == 1 )){
		//	$this->bayar_tambah = 1;
		//	$this->catatan = 'Tambahan Yuran: ';
		//}
		return true;
	}
	public function afterSave($insert, $changedAttributes)
    {
		parent::afterSave($insert, $changedAttributes);
		//if($this->bayar_tambah == 1){
		
			//Yii::$app->getDb()->createCommand("INSERT INTO yuran_bulanan (pelajar_id, bulan_tahun,bulan,tahun,bayaran,catatan,date_created) VALUES ('". $this->pelajar_id ."','". $this->bulan_tahun ."','". $this->bulan ."','". $this->tahun ."','". $this->bayaran ."','Bayaran Bulan: ','". $this->date_created ."'); UPDATE yuran_bulanan SET bayaran = '' WHERE id='". $this->id ."'; ")->execute();
		//}
		//date('m') substr($model->bulan_tahun,0,2)
		/*
		$baki = $this->baki;
		while($baki < 0 ){
			$bayaran = $baki > $this->yuran_bulanan ? $this->yuran_bulanan : abs($baki);
			// update if exist insert if not exist
			Yii::$app->getDb()->createCommand("INSERT INTO yuran_bulanan (pelajar_id,bulan_tahun,yuran_bulanan,bayaran,baki,date_created) VALUES ('". $this->pelajar_id ."','". $this->bulan_tahun ."','". $this->yuran_bulanan ."','". $bayaran ."','". $baki ."','". $this->date_created ."');")->execute();
			
			$baki = $baki + $this->yuran_bulanan;
		}
		$qry = Yii::$app->getDb()->createCommand("SELECT * FROM yuran_ringkasan 
		WHERE pelajar_id='". $this->pelajar_id ."' AND 
		tahun=SUBSTRING_INDEX('". $this->bulan_tahun ."','/',-1);")->queryOne(); 
		
		if($qry['id']>0){
			$jum = $qry['jum_bayaran'] + $this->bayaran;
			Yii::$app->getDb()->createCommand("UPDATE yuran_ringkasan SET jum_bayaran='".$jum."',tunggakan='". $this->baki ."' WHERE id='". $qry['id'] ."';")->execute(); 
		}else{
			Yii::$app->getDb()->createCommand("INSERT INTO yuran_ringkasan (pelajar_id,tahun,jum_bayaran,tunggakan) VALUES ('". $this->pelajar_id ."',SUBSTRING_INDEX('". $this->bulan_tahun ."','/',-1),'". $this->bayaran ."','". $this->baki ."');")->execute();  
		}
		*/
		return true;
	}
}
