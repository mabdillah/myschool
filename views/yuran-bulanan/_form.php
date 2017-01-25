<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
/* @var $this yii\web\View */
/* @var $model app\models\YuranBulanan */
/* @var $form yii\widgets\ActiveForm */
$pelajar_id=Yii::$app->getRequest()->getQueryParam('pelajar_id')?Yii::$app->getRequest()->getQueryParam('pelajar_id'):$model->pelajar_id;

//$data = Yii::$app->getDb()->createCommand("Select * FROM master_yuran WHERE tahun=year(curdate());")->queryOne(); 

//$data2 = Yii::$app->getDb()->createCommand("SELECT yuran_bulanan2 FROM `yuran_bulanan` WHERE pelajar_id = '".$pelajar_id."' AND tahun='".date('Y')."' AND flags_insert=1 ORDER BY `id` DESC LIMIT 1")->queryOne();
//$yuran_bulanan2 = $data2['yuran_bulanan2'];

//$data3 = Yii::$app->getDb()->createCommand("SELECT baki FROM `yuran_bulanan` WHERE pelajar_id = '".$pelajar_id."' AND tahun='".date('Y')."' ORDER BY `id` DESC LIMIT 1")->queryOne();
//$baki = $data3['baki'];
?>

<div class="yuran-bulanan-form">
<div class="row">
    <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['data-pjax' => true]]); ?>

    <?= $form->field($model, 'pelajar_id')->hiddenInput(['value'=>$pelajar_id])->label(false) ?>
	<?php 
	//$model->bulan_tahun = $model->bulan_tahun ? $model->bulan_tahun : date('m/Y');
	$model->date_created = $model->date_created ? $model->date_created : date('Y-m-d');

	?>
	<div class="col-sm-6">
    <?= $form->field($model, 'date_created')->widget(DateControl::classname(), [
		'type'=>'date',
	]);  ?>
	</div>
	<div class="clearfix"></div>
	<div class="col-sm-12">
	<?php 
	echo $form->field($model, 'catatan2')->textarea(['rows'=>3]);
	echo $form->field($model, 'tahun')->hiddenInput(['value'=>date('Y')])->label(false);
	?>
	</div>
	<div class="clearfix"></div>
	<div class="col-sm-6">
	<?php $model->bayaran = 0; ?>
    <?= $form->field($model, 'bayaran')->widget(\yii\widgets\MaskedInput::className(), [
			'clientOptions' => [
				'alias' => 'decimal',
				'groupSeparator' => ',',
				'autoGroup' => true,
				'removeMaskOnSubmit' => true
			],
			'options' => [
				//'onkeyup'=>'bayaranjs()',
				'class'=>"form-control"
			]
        ])->label('Bayaran (RM)') ?>
	</div>
<div class="clearfix"></div>
<div class="col-sm-6">
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Kemaskini', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>