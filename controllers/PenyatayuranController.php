<?php

namespace app\controllers;

use Yii;
use app\models\Penyatayuran;
use app\models\PelajarKelas;
use app\models\PenyatayuranSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PenyatayuranController implements the CRUD actions for Penyatayuran model.
 */
class PenyatayuranController extends Controller
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
     * Lists all Penyatayuran models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PenyatayuranSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Penyatayuran model.
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
     * Creates a new Penyatayuran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Penyatayuran();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            for($i=0;$i<count(Yii::$app->request->post('Penyatayuran')['id_kelas']);$i++){
                //echo $model->id_pelajar[0],$model->markah1[0],$model->markah2[0],$model->jumlah[0],$model->gred[0].'=';
                $rows = PelajarKelas::find()->select(['id_pelajar','id_kelas'])->distinct(true)->
                where(['id_kelas' =>Yii::$app->request->post('Penyatayuran')['id_kelas'][$i],'id_sesi'=>$model->id_sesi])->orderBy('id_pelajar')->all();
//                foreach ($rows as $row) {
//                    echo $row->id_pelajar."<br/>";
//            }
//                die();


                foreach ($rows as $row) {
                    $sql = "INSERT INTO yuran (darjah,id_pelajar,id_kelas,id_sesi,id_bulan,yuran_pelajaran,yuran_makan,
                    yuran_pengangkutan,yuran_tuisyen,yuran_tuisyen_makan,discount,jumlah_yuran)
            values ('$model->darjah',$row->id_pelajar,$row->id_kelas,'$model->id_sesi','$model->id_bulan','$model->yuran_belajar','$model->yuran_makan',
            '$model->yuran_pengangkutan','$model->yuran_tuisyen','$model->yuran_tuisyenmakan','$model->discount','$model->jumlah')";
                    Yii::$app->getDb()->createCommand($sql)->execute();
                   //echo $sql."<br/>";

//                    $sql = "UPDATE markah SET id_exam='$model->id_exam'
//                      WHERE id_markah='$row->id_markah' AND id_exam=0";
                    //  Yii::$app->getDb()->createCommand($sql)->execute();
                }

                //Yii::$app->getDb()->createCommand($sql)->execute();

            }
           //die();
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Penyatayuran model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_penyata]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Penyatayuran model.
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
     * Finds the Penyatayuran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Penyatayuran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Penyatayuran::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
