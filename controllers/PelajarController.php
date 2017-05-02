<?php

namespace app\controllers;

use app\models\PelajarKelas;
use Yii;
use app\models\Pelajar;
use app\models\YuranBulanan;
use app\models\PelajarSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\models\search\PizzaNotesSearch;
use kartik\mpdf\Pdf;


/**
 * PelajarController implements the CRUD actions for Pelajar model.
 */
class PelajarController extends Controller
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
     * Lists all Pelajar models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PelajarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$id_kelas = $searchModel->id_kelas > 0  ? $searchModel->id_kelas : '' ;
		
		if($id_kelas > 0 ){
			$dataProvider->query->andWhere("id IN (select id_pelajar from pelajar_kelas where id_kelas = '$id_kelas') ");
		}elseif(\Yii::$app->user->can('Guru')){
			$sql = Yii::$app->getDb()->createCommand("SELECT ifnull(GROUP_CONCAT(id_kelas SEPARATOR ', '),0) kelas FROM `kelas_mp` WHERE id_sesi = (select id from sesi where tahun = YEAR(curdate())) AND id_guru = (select id from guru where id_guru = '". Yii::$app->user->id ."') and id_matapelajaran != '';")->queryOne();
			$dataProvider->query->andWhere("id IN (select id_pelajar from pelajar_kelas where id_kelas IN (".$sql['kelas'].")) ");
		}

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionIndexKelas($idk=null)
    {
        $searchModel = new PelajarSearch();	
		if($idk > 0 ){
			$datakelas = Yii::$app->getDb()->createCommand("SELECT * FROM kelas WHERE id='". $idk ."' ;")->queryOne(); 
			//$searchModel->tingkatan = $datakelas['tingkatan'];
			//$searchModel->id_sesi = $datakelas['id_sesi'];
			//$searchModel->nama_kelas = $datakelas['nama_kelas'];
			$searchModel->id_kelas = $datakelas['id'];
		}
		
		//$datakelas = Yii::$app->getDb()->createCommand("SELECT id FROM kelas WHERE tingkatan='". $searchModel->tingkatan ."' AND id_sesi='". $searchModel->id_sesi ."' AND nama_kelas='". $searchModel->nama_kelas ."' ;")->queryOne(); 
		//$id_kelas = $datakelas['id'] > 0  ? $datakelas['id'] : $idk ;
		
		$searchModel->id_status = 1;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$id_kelas = $searchModel->id_kelas > 0  ? $searchModel->id_kelas : $idk ;
		
		if($id_kelas > 0 ){
			$dataProvider->query->andWhere("id IN (select id_pelajar from pelajar_kelas where id_kelas = '$id_kelas') ");
		}else{
			$dataProvider->query->andWhere("id NOT IN (select id_pelajar from pelajar_kelas where id_kelas in (select id from kelas where id_sesi in (select id from sesi where tahun >= year(curdate()) ) ) ) ");
		}

        return $this->render('index-kelas', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pelajar model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }



    /**
     * Creates a new Pelajar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pelajar();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			Yii::$app->session->setFlash('success', "Maklumat berjaya disimpan.");
			if(Yii::$app->request->post('btn')==1){
				return $this->redirect(['create']);
			}else{
				return $this->redirect(['view', 'id' => $model->id]);
			}
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pelajar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			Yii::$app->session->setFlash('success', "Maklumat berjaya dikemaskini.");
			if(Yii::$app->request->post('btn')==1){
				return $this->redirect(['update', 'id' => $model->id]);
			}else{
				return $this->redirect(['view', 'id' => $model->id]);
			}
        } else {
            $dataProvider = new ActiveDataProvider([
                'query' => $model->getKelasMp(),//filter pizzaNotes. dapatkan query dr fungsi getPizzaNotes di model/Pizza
                'pagination' => array( 'pageSize' => 20 ), //set number of page
            ]);

            return $this->render('update', [
                'model' => $model,
                'dataProvider'=>$dataProvider,
            ]);
        }
    }



    /**
     * Deletes an existing Pelajar model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	public function actionPoskod($id){
        $rows = \app\models\RefPoskod::find()->where(['postcode' => $id])->all();

        if(count($rows)>0){
            foreach($rows as $row){
                $state_name=$row["state_name"];  
                $post_office=$row["post_office"];  
            }
        }else{
             $state_name="-";
        }
      $values = ['state_name'=>$state_name,'post_office'=>$post_office];
      Yii::$app->response->format = 'json';
      return $values; 
    }
    /**
     * Finds the Pelajar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pelajar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pelajar::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionTetapan($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->post()) {
			//print_r(Yii::$app->request->post('tetapan'));die();
			$sql="";
			$sql2="";
			foreach ( Yii::$app->request->post('tetapan') as $key => $value ) {
				//echo 'key: '.$key . "= bulanan: ".$value['bulanan'] . "= flags: ".$value['flags'];
				if($value['flags'] > 0){
					$sql .= "UPDATE tetapan_yuranpelajar SET bulanan='".$value['bulanan']."', makan='". $value['makan'] ."',van='". $value['van'] ."',tuisyen='". $value['tuisyen'] ."',flags='". $value['flags'] ."',vanhala='".$value['vanhala']."',mkntuistyen='".$value['mkntuistyen']."' WHERE id='". $key ."';";
					$jum = $value['bulanan'] + $value['makan'] + $value['van'] + $value['tuisyen'];
					$_mkn = $value['makan'] > 0 ? 1 : 0;
					$_van = $value['van'] > 0 ? $value['vanhala'] : 0;
					//$_tuisyen = $value['tuisyen'] > 0 ? 1 : 0;
					$_tuisyen = $value['mkntuistyen'];
					$sql2 .= "INSERT INTO yuran_bulanan (pelajar_id,bulan_tahun,bulan,tahun,yuran_bulanan2,_van,_tuisyen,_makan,van,tuisyen,makan,date_created,catatan,flags_insert) VALUES ('".$id."','".$value['bulan'].'/'.date('Y')."','".$value['bulan']."','".date('Y')."','".$jum."' ,'".$_van."', '".$_tuisyen."', '".$_mkn."', '".$value['van']."', '".$value['tuisyen']."', '".$value['makan']."', CURDATE(),'Yuran Bulan: ',1); ";
				}
			}
			Yii::$app->getDb()->createCommand($sql)->execute();
			Yii::$app->getDb()->createCommand($sql2)->execute();
			Yii::$app->session->setFlash('success', "Maklumat berjaya disimpan.");
            return $this->redirect(['tetapan', 'id' => $model->id]);
        } else {
			$mykadbapa = YuranBulanan::findpelajar("no_mykadBapa",$id);
			$statusadik = YuranBulanan::findadik($mykadbapa);
			$biladikbradik = YuranBulanan::findbiladikberadik($mykadbapa);
			$statusadikpotong = 0;
			
			$yuran = YuranBulanan::findyuran(date('Y'));
			$yuran_bulanan = $yuran['yuran_bulanan'];
			$yatim = $yuran['yatim'];
			$adikberadik = $yuran['adik_beradik'];
			$adikberadik2 = $yuran['adikberadik_3'];
			$oku = $yuran['oku'];
			
			if($statusadik==$id){
				if($biladikbradik > 2){
					$yuran_bulanan = $yuran_bulanan-$adikberadik2;
				}else{
					$yuran_bulanan = $yuran_bulanan-$adikberadik;
				}
				$statusadikpotong = 1;
			}
			if(YuranBulanan::findpelajar("status_yatim",$id) == 1 ||  YuranBulanan::findpelajar("status_yatim",$id) == 2){
				$yuran_bulanan = $yuran_bulanan-$yatim;
			}
			if(YuranBulanan::findpelajar("status_OKU",$id) == 1 ){
				$yuran_bulanan = $yuran_bulanan-$oku;
			}
			$sttm = Yii::$app->getDb()->createCommand("select count(*) bil from tetapan_yuranpelajar WHERE id_pelajar = '".$id."' AND tahun='".date('Y')."' ")->queryOne();
			if($sttm['bil'] == 0){
				for($i=1;$i<=12;$i++){
					$sql = "INSERT INTO tetapan_yuranpelajar (id_pelajar,bulan,tahun,bulanan,makan,van,tuisyen) VALUES ('".$id."','".$i."','". date('Y') ."','".$yuran_bulanan."','0','0','0'); ";
					Yii::$app->getDb()->createCommand($sql)->execute();
				}
			}

            return $this->render('tetapan', [
                'model' => $model,
                'statusadikpotong' => $statusadikpotong,
                'yuran_bulanan' => $yuran_bulanan,
            ]);
        }
    }
	
	public function actionYuran()
    {
        $model = new \yii\base\DynamicModel(['pelajar_id']);
		$model	->addRule('pelajar_id', 'integer')
				->addRule('pelajar_id', 'required',['message' => 'Nama Pelajar tidak boleh dibiarkan kosong.'])
				->validate();

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['yuran-bulanan/view', 'pelajar_id' => $model->pelajar_id]);
        } else {
            return $this->render('_searchpelajar', [
                'model' => $model,
            ]);
        }
    }
	
	public function actionPenyataPdf($pelajar_id,$tahun) 
	{
		$model = $this->findModel($pelajar_id);
		$pdf = new Pdf([
			'content' => $this->renderPartial('penyata',[
				'model' => $model,
				'tahun' => $tahun,
			]),
			'mode'=>'utf-8',
			'format' => Pdf::FORMAT_A4, 
			// portrait orientation
			'orientation' => Pdf::ORIENT_PORTRAIT, 
			'options' => [
				'title' => 'Penyata Kira-Kira Pembiayaan Pelajar',
				'subject' => 'Penyata Kira-Kira Pembiayaan Pelajar'
			],
			'methods' => [
				'SetHeader' => ['Generated By: Sistem Maklumat Pelajar||Generated On: ' . date('l jS \of F Y h:i:s A')],
				'SetFooter' => ['|Page {PAGENO}|'],
			],
			'defaultFontSize'=>'8'
		]);
		return $pdf->render();
	}
}
