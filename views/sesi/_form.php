<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model app\models\Sesi */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <?php $form = ActiveForm::begin(); ?>
	<div class="col-sm-4">
    <?= $form->field($model, 'tahun')->textInput(['maxlength' => true]) ?>
	</div>
	<div class="clearfix"></div>
	<div class="col-sm-4">
	<?= $form->field($model, 'tarikh_mula')->widget(DateControl::classname(), [
		'type'=>'date',
	]) ?>
	</div>
	<div class="clearfix"></div>
	<div class="col-sm-4">
	<?= $form->field($model, 'tarikh_tamat')->widget(DateControl::classname(), [
		'type'=>'date',
	]) ?>
	</div>
	<div class="clearfix"></div>
	<div class="col-sm-4">
		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Kemaskini', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
	</div>
    <?php ActiveForm::end(); ?>
</div>