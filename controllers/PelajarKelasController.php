<?php

namespace app\controllers;

use Yii;
use app\models\PelajarKelas;
use app\models\Pelajar;
use app\models\search\PelajarKelasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * PelajarKelasController implements the CRUD actions for PelajarKelas model.
 */
class PelajarKelasController extends Controller
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
     * Lists all PelajarKelas models.
     * @return mixed
     */
    public function actionIndex($idk=null)
    {
        $searchModel = new PelajarKelasSearch();
		
		$searchModel->id_kelas = $searchModel->id_kelas > 0  ? $searchModel->id_kelas : $idk ;
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		if($searchModel->id_kelas > 0 ){
			$datakelas = Yii::$app->getDb()->createCommand("SELECT sesi.tahun FROM kelas INNER JOIN sesi ON sesi.id=kelas.id_sesi WHERE kelas.id='". $searchModel->id_kelas ."' ;")->queryOne(); 
			//$searchModel->tingkatan = $datakelas['tingkatan'];
			//$searchModel->id_sesi = $datakelas['id_sesi'];
			//$searchModel->nama_kelas = $datakelas['nama_kelas'];
			$idsesi = $datakelas['tahun'];
		}
		//echo $idsesi;die();
		//$datakelas = Yii::$app->getDb()->createCommand("SELECT id FROM kelas WHERE tingkatan='". $searchModel->tingkatan ."' AND id_sesi='". $searchModel->id_sesi ."' AND nama_kelas='". $searchModel->nama_kelas ."' ;")->queryOne(); 
		
		//$id_kelas = $datakelas['id'] > 0  ? $datakelas['id'] : $idk ;
		if($searchModel->id_kelas == ''){
			$dataProvider->query->andWhere("id IN (select id_pelajar from pelajar_kelas where id_kelas = '') ");
		}elseif($idsesi != date('Y')){
			$dataProvider->query->andWhere("id_pelajar NOT IN (select id_pelajar from pelajar_kelas where id_kelas IN (select id from kelas where id_sesi = (select id from sesi where tahun = year(curdate())))) ");
		}
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionBulk(){
		$model = new PelajarKelas();
		if ($model->load(Yii::$app->request->post())) {
			//foreach(Yii::$app->session->get('idpelajar') as $id){
			$selection=Yii::$app->request->post('selection');
			foreach($selection as $id){
				$sql = "DELETE FROM `pelajar_kelas` WHERE id_pelajar='$id' AND id_kelas in (select id from kelas where id_sesi in (select id from sesi where tahun IN (SELECT tahun FROM `kelas` inner join sesi on sesi.id=kelas.id_sesi where kelas.id='". $model->id_kelas ."')));
				INSERT INTO pelajar_kelas (id_pelajar, id_kelas) SELECT '$id', '". $model->id_kelas ."' FROM DUAL WHERE NOT EXISTS (SELECT id FROM pelajar_kelas WHERE id_pelajar = '$id' AND id_kelas='". $model->id_kelas ."');";
				Yii::$app->getDb()->createCommand($sql)->execute(); 
			}
			Yii::$app->session->setFlash('success', "Maklumat berjaya disimpan.");
			unset(Yii::$app->session['idpelajar']);
			return $this->redirect(['index', 'idk' => $model->id_kelas]);
			//return $this->redirect(['pelajar/index-kelas', 'idk' => $model->id_kelas]);
        }else{
			$selection=Yii::$app->request->post('selection');
			foreach($selection as $id){
				$idpelajar[] = $id;
			}
			Yii::$app->session['idpelajar'] = $idpelajar;
			$idpelajar2 = implode (", ", $idpelajar);
			
			$dataProvider = new ActiveDataProvider([
				'query' => Pelajar::find()->where("id IN ($idpelajar2)")->orderBy('nama_pelajar ASC'),
				'pagination' => [ 'pageSize' => 40 ],
			]);
			return $this->render('index-bulk', [
				'model' => $model,
				'dataProvider' => $dataProvider,
			]);
		}
	}

    /**
     * Displays a single PelajarKelas model.
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
     * Creates a new PelajarKelas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_kelas=null)
    {
        $model = new PelajarKelas();

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['create', 'id_kelas' => $model->id_kelas]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'id_kelas' => $id_kelas,
            ]);
        }
    }

    /**
     * Updates an existing PelajarKelas model.
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
     * Deletes an existing PelajarKelas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
		$model->delete();
		Yii::$app->session->setFlash('success', "Maklumat berjaya dipadam.");
        return $this->redirect(['index', 'idk' => $model->id_kelas]);
    }

    /**
     * Finds the PelajarKelas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PelajarKelas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PelajarKelas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	public function actionViewpelajar($pelajar=null,$id_kelas=null)
    {
        return $this->renderPartial('pelajar', [
            'pelajar' => $pelajar,
            'id_kelas' => $id_kelas,
        ]);
    }
	public function actionDeletepelajar($id=null,$id_kelas=null)
    {
        Yii::$app->db->createCommand("DELETE FROM pelajar_kelas WHERE id = '".$id."';")->execute();
        return $this->renderPartial('pelajar', [
				'pelajar' => null,
				'id_kelas' => $id_kelas,
			]);
		
	}
}
