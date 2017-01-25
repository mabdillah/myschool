<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
$id_kelas=Yii::$app->getRequest()->getQueryParam('kelas_id') ? Yii::$app->getRequest()->getQueryParam('kelas_id') : $model->id_kelas;
//$id_pelajar=Yii::$app->getRequest()->getQueryParam('pelajar_id') ? Yii::$app->getRequest()->getQueryParam('pelajar_id') : $model->id_pelajar;


/* @var $this yii\web\View */
/* @var $model app\models\PelajarKelas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pelajar-kelas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_sesi')->dropDownList(ArrayHelper::map(
        \app\models\Sesi::find()
            ->all(),'id_sesi','tahun'),['prompt'=>'Please Choose One']); ?>

    <?= $form->field($model, 'id_pelajar')->dropDownList(ArrayHelper::map(
        \app\models\Kelas::find()
            ->all(),'id','nama_kelas'),['prompt'=>'Please Choose One']); ?>

    <?= $form->field($model, 'id_kelas')->dropDownList(ArrayHelper::map(
        \app\models\Kelas::find()
            ->all(),'id','nama_kelas'),['prompt'=>'Please Choose One']); ?>




    <?= $form->field($model, 'darjah')->radioList(['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6']) ?>



    <div class="form-group">
        <?= Html::submitButton( 'Save',['class' =>  'btn btn-success','name'=>'btn','value'=>'2']) ?>
    </div>

    <?php ActiveForm::end(); ?>
