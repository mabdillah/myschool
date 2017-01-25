<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;
$id_guru=Yii::$app->getRequest()->getQueryParam('guru_id') ? Yii::$app->getRequest()->getQueryParam('guru_id') : $model->id_guru;

/* @var $this yii\web\View */
/* @var $model app\models\Guru */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="guru-form">
<div class="row">
    <?php $form = ActiveForm::begin(); ?>
<?= $form->errorSummary($model); ?>
	<div class="col-sm-4">
    <?= $form->field($model, 'nama_guru')->textInput(['maxlength' => true]) ?>
	</div>
	<div class="col-sm-4">
    <?= $form->field($model, 'ic')->widget(\yii\widgets\MaskedInput::className(), [
		'mask' => '999999-99-9999'
	]) ?>
	</div>
	<div class="clearfix"></div>
	<div class="col-sm-4">
    <?= $form->field($model, 'no_tel')->widget(\yii\widgets\MaskedInput::className(), [ 'mask' => '99[9]-9999999[9]']) ?>
	</div>
	<div class="col-sm-4">
    <?= $form->field($model, 'alamat')->textarea(['rows' => 3]) ?>
	</div>
	<div class="clearfix"></div>
	
	
	<div class="col-sm-12">
		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Kemaskini', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
