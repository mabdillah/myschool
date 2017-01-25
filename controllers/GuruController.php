<?php

namespace app\controllers;

use Yii;
use app\models\Guru;
use app\models\GuruSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * GuruController implements the CRUD actions for Guru model.
 */
class GuruController extends Controller
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
     * Lists all Guru models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GuruSearch();
		if(!\Yii::$app->user->can('Admin')){
			$searchModel->id_guru = Yii::$app->user->id;
		}
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Guru model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id,$tahun=null)
    {
		if(Yii::$app->request->post()){
			$tahun = Yii::$app->request->post('tahun');
		}else{
			$tahun = date('Y');
		}
        return $this->render('view', [
            'model' => $this->findModel($id),
            'tahun' => $tahun,
        ]);
    }

    /**
     * Creates a new Guru model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Guru();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {	
			Yii::$app->session->setFlash('success', "Maklumat berjaya disimpan.");
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Guru model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			Yii::$app->session->setFlash('success', "Maklumat berjaya dikemaskini.");
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $dataProvider = new ActiveDataProvider([
                'query' => $model->getKelas(),//filter pizzaNotes. dapatkan query dr fungsi getPizzaNotes di model/Pizza
                'pagination' => array( 'pageSize' => 20 ), //set number of page
            ]);


            return $this->render('update', [
                'model' => $model,
                'dataProvider'=>$dataProvider,

            ]);
        }
    }
    public function actionMp($id)
    {
        $model = $this->findModel($id);
		$model2 = new \yii\base\DynamicModel(['sesi','kelas','matapelajaran','darjah']);
		$model2->addRule(['kelas','matapelajaran'], 'safe')
		->addRule(['sesi','darjah'], 'integer');

        if ($model2->load(Yii::$app->request->post())) {
			if(Yii::$app->request->post('btn')==2){
				//echo '<pre>';
				//print_r(count(Yii::$app->request->post('DynamicModel')['kelas']));
				//print_r( Yii::$app->request->post());
				//die();
				$condition="";
				if($model2->darjah > 0){
					$condition=" AND id_kelas IN (SELECT id FROM kelas WHERE tingkatan = '". $model2->darjah ."') ";
				}
				Yii::$app->getDb()->createCommand("DELETE FROM kelas_mp WHERE id_guru='$id' AND id_sesi = '". $model2->sesi ."' $condition ;")->execute();
				//$a='';
				for($i=0;$i<count(Yii::$app->request->post('DynamicModel')['kelas']);$i++){
					if(is_array(Yii::$app->request->post('matapelajaran')[$i])) {
						$matapelajaran = implode(',', Yii::$app->request->post('matapelajaran')[$i]);
					}else{
						$matapelajaran = "";
					}
					//$a .= $matapelajaran;
					//echo $model2->kelas[$i]." + ".$matapelajaran ."<br/>"; die();
					$sql = "
					INSERT INTO kelas_mp (id_kelas, id_guru, id_matapelajaran,id_sesi) VALUES ('".$model2->kelas[$i] ."', '". $id ."', '".$matapelajaran ."','". $model2->sesi ."' ); ";
					Yii::$app->getDb()->createCommand($sql)->execute();
					
				}
				//print_r(Yii::$app->request->post());
				//echo '</pre>';
				//die();
				Yii::$app->session->setFlash('success', "Maklumat berjaya disimpan.");
			}
            return $this->render('_mp', [
                'model' => $model,
                'model2' => $model2,
            ]);
        }else{
			$curyear = Yii::$app->getDb()->createCommand("SELECT id FROM `sesi` WHERE tahun= year(curdate()) LIMIT 1;")->queryOne(); 
			$model2->sesi = $curyear['id'];
            return $this->render('_mp', [
                'model' => $model,
                'model2' => $model2,
            ]);
        }
    }
    /**
     * Deletes an existing Guru model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
		Yii::$app->session->setFlash('success', "Maklumat berjaya dipadam.");
        return $this->redirect(['index']);
    }

    /**
     * Finds the Guru model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Guru the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Guru::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
