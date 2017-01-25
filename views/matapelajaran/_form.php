<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Matapelajaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matapelajaran-form">
<div class="row">
    <?php $form = ActiveForm::begin(); ?>
	<div class="col-sm-4">
    <?= $form->field($model, 'kod_matapelajaran')->textInput(['maxlength' => true]) ?>
	</div>
	<div class="clearfix"></div>
	<div class="col-sm-4">
    <?= $form->field($model, 'nama_matapelajaran')->textInput(['maxlength' => true]) ?>
	</div>
	<div class="clearfix"></div>
	<div class="col-sm-4">
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Kemaskini', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
