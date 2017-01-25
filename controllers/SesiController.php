<?php

namespace app\controllers;

use Yii;
use app\models\Sesi;
use app\models\SesiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * SesiController implements the CRUD actions for Sesi model.
 */
class SesiController extends Controller
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
     * Lists all Sesi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SesiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sesi model.
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
     * Creates a new Sesi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sesi();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {	
			Yii::$app->session->setFlash('success', "Maklumat berjaya disimpan.");
            return $this->redirect(['create']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Sesi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_sesi]);
        } else {
            $dataProvider = new ActiveDataProvider([
                'query' => $model->getExam(),//filter pizzaNotes. dapatkan query dr fungsi getPizzaNotes di model/Pizza
                'pagination' => array( 'pageSize' => 20 ), //set number of page
            ]);
            $dataProvider2 = new ActiveDataProvider([
                'query' => $model->getKelasMp(),//filter pizzaNotes. dapatkan query dr fungsi getPizzaNotes di model/Pizza
                'pagination' => array( 'pageSize' => 20 ), //set number of page
            ]);

            return $this->render('update', [
                'model' => $model,
                'dataProvider'=>$dataProvider,
                'dataProvider2'=>$dataProvider2,
            ]);
        }
    }

    /**
     * Deletes an existing Sesi model.
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
     * Finds the Sesi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sesi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sesi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
