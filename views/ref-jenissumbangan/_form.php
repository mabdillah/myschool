<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RefJenissumbangan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-jenissumbangan-form">

    <?php $form = ActiveForm::begin(); ?>
	<div class="col-sm-8">
    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>
	</div>
	<div class="clearfix"></div>
	<div class="col-sm-8">
         <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Kemaskini', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
