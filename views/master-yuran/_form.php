<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\MasterYuran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="master-yuran-form">

    <?php $form = ActiveForm::begin(); ?>
	<div class="col-sm-4">
    <?= $form->field($model, 'tahun')->widget(Select2::classname(),['data' => ArrayHelper::map(\app\models\Sesi::find()->orderBy('tahun')->orderBy('tahun DESC')->all(),'tahun', 'tahun' ),'pluginOptions'=>['allowClear'=>true],'options' => ['placeholder' => 'Sila Pilih']]) ?>
	</div>
	<div class="col-sm-4">
    <?= $form->field($model, 'yuran_bulanan')->textInput(['maxlength' => true]) ?>
	</div>
	<div class="clearfix"></div>
	<div class="col-sm-4">
    <?= $form->field($model, 'makan')->textInput(['maxlength' => true]) ?>
	</div>
	<div class="col-sm-4">
    <?= $form->field($model, 'tuisyen')->textInput(['maxlength' => true]) ?>
	</div>
	<div class="col-sm-4">
    <?= $form->field($model, 'makan_tuisyen')->textInput(['maxlength' => true]) ?>
	</div>
	<div class="clearfix"></div>
	<div class="col-sm-4">
    <?= $form->field($model, 'yatim')->textInput(['maxlength' => true]) ?>
	</div>
	<div class="col-sm-4">
    <?= $form->field($model, 'oku')->textInput(['maxlength' => true]) ?>
	</div>
	<div class="clearfix"></div>
	<div class="col-sm-4">
    <?= $form->field($model, 'adik_beradik')->textInput(['maxlength' => true]) ?>
	</div>
	<div class="col-sm-4">
    <?= $form->field($model, 'adikberadik_3')->textInput(['maxlength' => true]) ?>
	</div>
	<div class="clearfix"></div>
	<div class="col-sm-4">
		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Kemaskini', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
