<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model app\models\YuranBulananSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="yuran-bulanan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
<div class="row">
	<div class="col-sm-4">
    <?= $form->field($model, 'date_created')->widget(DateControl::classname(), [
		'type'=>'date'
	])->label('Tarikh: Dari'); ?>
	</div>
	<div class="col-sm-4">
    <?= $form->field($model, 'end_date')->widget(DateControl::classname(), [
		'type'=>'date'
	]); ?>
	</div>
    <?php // echo $form->field($model, 'tuisyen') ?>

    <?php // echo $form->field($model, 'makan') ?>

    <?php // echo $form->field($model, 'bayaran') ?>

    <?php // echo $form->field($model, 'baki') ?>

    <?php // echo $form->field($model, 'date_created') ?>

    <div class="clearfix"></div>
	<div class="col-sm-12">
    <div class="form-group">
        <?= Html::submitButton('Carian', ['class' => 'btn btn-primary']) ?>
    </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
