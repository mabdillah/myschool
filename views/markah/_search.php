<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MarkahSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="markah-search">
<div class="row">

    <?php $form = ActiveForm::begin([
        //'action' => ['index-markah'],
        'method' => 'get',
    ]); ?>
	<div class="col-sm-4">
    <?= $form->field($model, 'tahun')->dropdownlist(yii\helpers\ArrayHelper::map(app\models\sesi::find()->orderby('tahun DESC')->all(),'tahun', 'tahun'),['prompt'=>'Sila Pilih']); ?>
	</div>
	<div class="col-sm-4">
    <?= $form->field($model, 'peperiksaan')->dropdownlist(yii\helpers\ArrayHelper::map(app\models\RefExam::find()->all(),'id', 'keterangan'),['prompt'=>'Sila Pilih']); ?>
	</div>
    <?php // echo $form->field($model, 'jumlah') ?>

    <?php // echo $form->field($model, 'gred') ?>

    <div class="clearfix"></div>
    <div class="col-sm-12">
		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
		</div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
