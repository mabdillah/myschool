<?php

namespace app\controllers;

use Yii;
use app\models\Markah;
use app\models\MarkahSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MarkahController implements the CRUD actions for Markah model.
 */
class MarkahController extends Controller
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
     * Lists all Markah models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MarkahSearch();
		if(!isset(Yii::$app->request->queryParams['MarkahSearch']['darjah'])){
			$searchModel->darjah = 1;
			$darjah = 1;
		}else{
			$darjah = Yii::$app->request->queryParams['MarkahSearch']['darjah'];
		}
		if(!isset(Yii::$app->request->queryParams['MarkahSearch']['tahun'])){
			$searchModel->tahun = date('Y');
			$tahun = date('Y');
		}else{
			$tahun = Yii::$app->request->queryParams['MarkahSearch']['tahun'];
		}
		if(!isset(Yii::$app->request->queryParams['MarkahSearch']['peperiksaan'])){
			$searchModel->peperiksaan = 1;
			$periksa = 1;
		}else{
			$periksa = Yii::$app->request->queryParams['MarkahSearch']['peperiksaan'];
		}
		
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tahun' => $tahun,
            'periksa' => $periksa,
            //'darjah' => $darjah,
        ]);
    }
    public function actionIndexMarkah()
    {
        $searchModel = new MarkahSearch();
		if(!isset(Yii::$app->request->queryParams['MarkahSearch']['tahun'])){
			$searchModel->tahun = date('Y')-1;
			$tahun = date('Y')-1;
		}else{
			$tahun = Yii::$app->request->queryParams['MarkahSearch']['tahun'];
		}
		if(!isset(Yii::$app->request->queryParams['MarkahSearch']['peperiksaan'])){
			$searchModel->peperiksaan = 2;
			$periksa = 2;
		}else{
			$periksa = Yii::$app->request->queryParams['MarkahSearch']['peperiksaan'];
		}
		
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		$dataProvider->query->andWhere("id_pelajar NOT IN (select id_pelajar from pelajar_kelas where id_kelas IN (select id from kelas where id_sesi = (select id from sesi where tahun = '".$tahun."' ))) ");

        return $this->render('index-markah', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tahun' => $tahun,
            'periksa' => $periksa,
        ]);
    }

    /**
     * Displays a single Markah model.
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
     * Creates a new Markah model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Markah();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Markah model.
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
     * Deletes an existing Markah model.
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
     * Finds the Markah model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Markah the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Markah::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
