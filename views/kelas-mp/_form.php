<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\KelasMp */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kelas-mp-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_sesi')->dropDownList(ArrayHelper::map(
        \app\models\Sesi::find()
            ->all(),'id_sesi','tahun'),['prompt'=>'Please Choose One']); ?>

    <?= $form->field($model, 'id_kelas')->dropDownList(ArrayHelper::map(
        \app\models\Kelas::find()
            ->all(),'id','nama_kelas'),['prompt'=>'Please Choose One']); ?>

    <?= $form->field($model, 'id_guru')->dropDownList(ArrayHelper::map(
        \app\models\Guru::find()
            ->all(),'id_guru','nama_guru'),['prompt'=>'Please Choose One']); ?>

    <?= $form->field($model, 'id_matapelajaran')->checkboxList(ArrayHelper::map(
        \app\models\Matapelajaran::find()
            ->all(),'id_matapelajaran','nama_matapelajaran'),['prompt'=>'Please Choose One']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Simpan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
