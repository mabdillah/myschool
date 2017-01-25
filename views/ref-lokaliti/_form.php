<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RefLokaliti */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-lokaliti-form">
<div class="row">
    <?php $form = ActiveForm::begin(); ?>

    <?php //echo $form->field($model, 'Kod_Negeri')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'Kod_Parlimen')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'Kod_DUN')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'Kod_Daerah')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'Kod_Lokaliti')->textInput(['maxlength' => true]) ?>
	<div class="col-sm-4">
    <?= $form->field($model, 'Nama_Lokaliti')->textInput(['maxlength' => true]) ?>
	</div><div class="clearfix"></div>
	<div class="col-sm-4">
    <?= $form->field($model, 'harga_van')->textInput(['maxlength' => true]) ?>
	</div>
	<div class="clearfix"></div>
	<div class="col-sm-4">
		<?= $form->field($model, 'harga_van2')->textInput(['maxlength' => true]) ?>
	</div>
	<div class="clearfix"></div>
	<div class="col-sm-4">
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Simpan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
