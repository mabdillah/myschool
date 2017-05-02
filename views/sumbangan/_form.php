<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;
/* @var $this yii\web\View */
/* @var $model app\models\Sumbangan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sumbangan-form">

    <?php $form = ActiveForm::begin(); ?>
	<div class="col-sm-8">
    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>
	</div>
	<div class="col-sm-8">
    <?= $form->field($model, 'id_jenissumbangan')->widget(Select2::classname(),
	[
	'data' => ArrayHelper::map(app\models\RefJenissumbangan::find()->orderBy('keterangan')->all(),'id', 'keterangan' ),
	'pluginOptions'=>['allowClear'=>true],
	'options' => ['placeholder' => 'Carian Jenis',]]
	) ?>
	</div>
	<div class="col-sm-8">
    <?= $form->field($model, 'jumlah')->textInput(['maxlength' => true]) ?>
	</div>
	<?php 
	$model->tarikh_sumbangan = $model->tarikh_sumbangan ? $model->tarikh_sumbangan : date('Y-m-d') ;
	?>
	<div class="col-sm-8">
    <?= $form->field($model, 'tarikh_sumbangan')->widget(DateControl::classname(), [
	'type'=>'date',
	]) ?>
	</div>
	<div class="col-sm-8">
    <?= $form->field($model, 'catatan')->textarea([
	'row'=>'3',
	]) ?>
	</div>

    <?= $form->field($model, 'user_id')->hiddenInput(['value'=>Yii::$app->user->id])->label(false) ?>

	<div class="clearfix"></div>
    <div class="col-sm-12">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Kemaskini', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
