<?php

namespace app\controllers;

use Yii;
use app\models\Pelajar;
use app\models\YuranBulanan;
use app\models\YuranBulananSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use kartik\mpdf\Pdf;

/**
 * YuranBulananController implements the CRUD actions for YuranBulanan model.
 */
class YuranBulananController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all YuranBulanan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new YuranBulananSearch();
		$searchModel->flags_insert = 0;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single YuranBulanan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($pelajar_id,$tahun=null)
    {		
		if(Yii::$app->request->post()){
			$tahun = Yii::$app->request->post('tahun');
		}else{
			$tahun = date('Y');
		}
		
		$sql="select count(pelajar.id) pbil from pelajar inner join pelajar_kelas on pelajar_kelas.id_pelajar=pelajar.id inner join kelas on kelas.id=pelajar_kelas.id_kelas inner join sesi on sesi.id=kelas.id_sesi WHERE pelajar.id='$pelajar_id' AND sesi.tahun=".$tahun;
		$bdata = Yii::$app->getDb()->createCommand($sql)->queryOne(); 
		 
		$masteryuran = Yii::$app->getDb()->createCommand("SELECT id FROM `master_yuran` WHERE tahun='$tahun';")->query();
		$rowCount = $masteryuran->rowCount;
		//echo $rowCount.'+';die();
		if($rowCount==0){
			Yii::$app->session->setFlash('danger', "Tiada maklumat tetapan yuran. Sila klik ".Html::a('sini', ['/master-yuran/create'])." untuk tetapan yuran.");
		}elseif(YuranBulanan::findpelajar('id_status',$pelajar_id) == 1 && $bdata['pbil']>0){
			/*$data = Yii::$app->getDb()->createCommand("SELECT concat(tahun,'-',bulan,'-','01') as lastinsert FROM `yuran_bulanan` WHERE pelajar_id = '".$pelajar_id."' AND tahun='".$tahun."' AND flags_insert=1 order by bulan desc, tahun desc LIMIT 1")->queryOne();
			
			$data3 = Yii::$app->getDb()->createCommand("SELECT baki FROM `yuran_bulanan` WHERE pelajar_id = '".$pelajar_id."' AND tahun='".$tahun."' ORDER BY `id` DESC LIMIT 1")->queryOne();
			$baki = $data3['baki'];

			$sesi = YuranBulanan::findSesi($tahun);
			$startmonth = strtotime($data['lastinsert']) == 0 ? strtotime($sesi['tarikh_mula']) : strtotime("first day of next month", strtotime($data['lastinsert']));
			$endmonth = strtotime(date('Y-m-d')) < strtotime($sesi['tarikh_tamat']) ? strtotime(date('Y-m-d')) : strtotime($sesi['tarikh_tamat']) ;
			
			$mykadbapa = YuranBulanan::findpelajar("no_mykadBapa",$pelajar_id);
			$statusadik = YuranBulanan::findadikberadik($mykadbapa);
			
			$yuran = YuranBulanan::findyuran($tahun);
			$yuran_bulanan = $yuran['yuran_bulanan'];
			$yatim = $yuran['yatim'];
			$adikberadik = $yuran['adik_beradik'];
			$oku = $yuran['oku'];
			
			if($statusadik==YuranBulanan::findpelajar("no_mykid",$pelajar_id)){
				$yuran_bulanan = $yuran_bulanan-$adikberadik;
			}
			if(YuranBulanan::findpelajar("status_yatim",$pelajar_id) == 1 ||  YuranBulanan::findpelajar("status_yatim",$pelajar_id) == 2){
				$yuran_bulanan = $yuran_bulanan-$yatim;
			}
			if(YuranBulanan::findpelajar("status_OKU",$pelajar_id) == 1 ){
				$yuran_bulanan = $yuran_bulanan-$oku;
			}
			
			while($startmonth < $endmonth)
			{
				$tarikh = date('Y-m-d',$startmonth);
				$bulan = date('m',$startmonth);
				$tahun = date('Y',$startmonth);
				$baki = $baki + $yuran_bulanan;
				$sql = "INSERT INTO yuran_bulanan (pelajar_id,bulan_tahun,bulan,tahun,yuran_bulanan2,bayaran,baki,date_created,catatan,flags_insert) VALUES ('".$pelajar_id."','".$bulan.'/'.$tahun."','".$bulan."','".$tahun."','".$yuran_bulanan."',0,'".$baki."','".$tarikh."','Yuran Bulan: ',1); ";
				Yii::$app->getDb()->createCommand($sql)->execute();
				//$startmonth = strtotime("+1 month", $startmonth);
				$startmonth = strtotime("first day of next month", $startmonth);
			}*/
		}
		$pelajar = Pelajar::findOne($pelajar_id);
        return $this->render('view', [
            'model' => $pelajar,
            'tahun' => $tahun,
        ]);
    }

    /**
     * Creates a new YuranBulanan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new YuranBulanan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['view', 'pelajar_id' => $model->pelajar_id]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing YuranBulanan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing YuranBulanan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the YuranBulanan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return YuranBulanan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = YuranBulanan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	
}
