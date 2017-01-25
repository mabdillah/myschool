<?php

namespace app\controllers;

use Yii;
use app\models\Exam;
use app\models\ExamSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * ExamController implements the CRUD actions for Exam model.
 */
class ExamController extends Controller
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
     * Lists all Exam models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ExamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Exam model.
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
     * Creates a new Exam model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_kelas,$id_matapelajaran)
    {
        $model = new Exam();
		$model->scenario = 'create';
        if ($model->load(Yii::$app->request->post())) {
			$sql = Yii::$app->getDb()->createCommand("SELECT id FROM `pelajar_kelas` WHERE id_kelas='". $model->id_kelas ."'")->query();
			$rowCount = $sql->rowCount;
			if($rowCount > 0 ){
				if($model->save()){
					Yii::$app->getDb()->createCommand("INSERT INTO markah (id_pelajar,id_exam,markah1,markah2,jumlah) (SELECT id_pelajar,". $model->id .",0,0,0 FROM `pelajar_kelas` WHERE id_kelas='". $model->id_kelas ."')")->execute(); 
					return $this->redirect(['update', 'id' => $model->id]);
				}else{
					Yii::$app->session->setFlash('danger', "Maklumat telah wujud.");
					return $this->redirect(['create', 'id_kelas' => $id_kelas,'id_matapelajaran'=>$id_matapelajaran]);
				}
			}else{
				Yii::$app->session->setFlash('danger', "Kelas dipilih tiada rekod pelajar.");
				return $this->redirect(['create', 'id_kelas' => $id_kelas,'id_matapelajaran'=>$id_matapelajaran]);
			}
        } else {
            return $this->render('create', [
                'model' => $model,
                'id_kelas' => $id_kelas,
                'id_matapelajaran' => $id_matapelajaran,
            ]);
        }
    }

    /**
     * Updates an existing Exam model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		/*$dataProvider = new ActiveDataProvider([
			'query' => $model->getMarkah(),
		]);*/

        if ($model->load(Yii::$app->request->post())) {
			for($i=0;$i<count(Yii::$app->request->post('id'));$i++){
				Yii::$app->getDb()->createCommand("UPDATE markah SET markah1='". Yii::$app->request->post('markah1')[$i] ."',markah2='". Yii::$app->request->post('markah2')[$i] ."',gred='". Yii::$app->request->post('gred')[$i] ."',jumlah='". Yii::$app->request->post('jumlah')[$i] ."' WHERE id_pelajar='". Yii::$app->request->post('id')[$i] ."' AND id_exam='". $model->id ."';")->execute(); 
			}
			Yii::$app->session->setFlash('success', "Maklumat berjaya disimpan.");
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                //'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Deletes an existing Exam model.
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
     * Finds the Exam model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Exam the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Exam::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionGred($val)
    {
        $sql = "Select gred FROM ref_gred where '$val' >= min_mark AND '$val' <= max_mark ";
        $grade = Yii::$app->getDb()->createCommand($sql)->queryOne();
        return $grade['gred']?$grade['gred']:'-';
    }
}
