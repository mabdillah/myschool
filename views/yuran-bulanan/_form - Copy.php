<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
/* @var $this yii\web\View */
/* @var $model app\models\YuranBulanan */
/* @var $form yii\widgets\ActiveForm */
$pelajar_id=Yii::$app->getRequest()->getQueryParam('pelajar_id')?Yii::$app->getRequest()->getQueryParam('pelajar_id'):$model->pelajar_id;

$data = Yii::$app->getDb()->createCommand("Select * FROM master_yuran WHERE tahun=year(curdate());")->queryOne(); 

$data2 = Yii::$app->getDb()->createCommand("SELECT yuran_bulanan2 FROM `yuran_bulanan` WHERE pelajar_id = '".$pelajar_id."' AND tahun='".date('Y')."' AND flags_insert=1 ORDER BY `id` DESC LIMIT 1")->queryOne();
$yuran_bulanan2 = $data2['yuran_bulanan2'];

$data3 = Yii::$app->getDb()->createCommand("SELECT baki FROM `yuran_bulanan` WHERE pelajar_id = '".$pelajar_id."' AND tahun='".date('Y')."' ORDER BY `id` DESC LIMIT 1")->queryOne();
$baki = $data3['baki'];
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
	<div class="col-sm-6">
    <?php 
	//echo $form->field($model, 'bulan_tahun')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '99/9999',]);  
	$year = date('Y');
	echo $form->field($model, 'bulan_tahun')->dropdownList(['01/'.$year=>'Januari', '02/'.$year=>'Febuari', '03/'.$year=>'Mac', '04/'.$year=>'April', '05/'.$year=>'Mei', '06/'.$year=>'Jun', '07/'.$year=>'Julai', '08/'.$year=>'Ogos', '09/'.$year=>'September', '10/'.$year=>'Oktober', '11/'.$year=>'November', '12/'.$year=>'Disember'],['prompt'=>'Sila Pilih']);
	?>
	</div><div class="clearfix"></div>
	<div class="col-sm-12">
	<?php 
	echo $form->field($model, 'catatan2')->textarea(['rows'=>3]);
	?>
	</div><div class="clearfix"></div>
	<?= '<hr>' ?>
	<div class="clearfix"></div>
	<div class="col-sm-6">
	<?= Html::label('Van') ?>
	<?= $form->field($model, '_van')->checkbox(['onclick' => 'bayaranjs()','id'=>'_van','label'=>'']) ?>
	</div>
	<div class="col-sm-6">
    <?= $form->field($model, 'van')->textInput(['readonly' => true,'value'=>$model->getYuranvan($pelajar_id,"harga_van")])->label(false) ?>
	</div><div class="clearfix"></div>
	<div class="col-sm-6">
	
	<?= Html::label('Tuisyen') ?>
    <?= $form->field($model, '_tuisyen')->checkbox(['onclick' => 'bayaranjs()','id'=>'_tuisyen','label'=>'']) ?>
	</div>
	<div class="col-sm-6">
    <?= $form->field($model, 'tuisyen')->textInput(['readonly' => true,'value'=>$data['tuisyen']])->label(false) ?>
	
	</div><div class="clearfix"></div>
	<div class="col-sm-6">
	<?= Html::label('Makan') ?>
	<?= $form->field($model, '_makan')->checkbox(['onclick' => 'bayaranjs()','id'=>'_makan','label'=>'']) ?>
	</div>
	<div class="col-sm-6">
    <?= $form->field($model, 'makan')->textInput(['readonly' => true,'value'=>$data['makan']])->label(false) ?>
	<?= '<hr/>' ?>
	</div><div class="clearfix"></div>
	
    <?= $form->field($model, 'yuran_bulanan')->hiddenInput(['readonly' => true,'value'=>$yuran_bulanan2])->label(false) ?>
    <?php echo $form->field($model, 'yuran_bulanan2')->hiddenInput(['readonly' => true,'value'=>0])->label(false) ?>
	
	<div class="col-sm-6">
	
    <?= Html::label('Jumlah Perlu dibayar') ?>
    <?= Html::textInput('_yuranperlubayar',$data['yuran_bulanan'],['id'=>'id-yuranperlubayar','class'=>'form-control',]) ?>
	</div>
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
				'onkeyup'=>'bayaranjs()',
				'class'=>"form-control"
			]
        ]) ?>
	</div>
    <?= $form->field($model, 'baki')->hiddenInput(['readonly' => true,'value'=>$baki])->label(false) ?>
	<?= Html::hiddenInput('_baki',$baki,['id'=>'id-baki','class'=>'form-control',]) ?>
<div class="clearfix"></div>
<div class="col-sm-6">
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Kemaskini', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
<script>
	function bayaranjs(){
		var bayaranakhir=0;
		var tambahan=0;
		var yuranbulanan = document.getElementById("yuranbulanan-yuran_bulanan").value;
		var bayaran = document.getElementById("yuranbulanan-bayaran").value;
		
		var van = document.getElementById("_van").checked ? Number(document.getElementById("yuranbulanan-van").value) : 0;
		var tuisyen = document.getElementById("_tuisyen").checked ? Number(document.getElementById("yuranbulanan-tuisyen").value) : 0;
		var makan = document.getElementById("_makan").checked ? Number(document.getElementById("yuranbulanan-makan").value) : 0;
		
		yuranbulanan = Number(yuranbulanan) + van + tuisyen + makan;
		tambahan = van + tuisyen + makan;
		//document.getElementById("yuranbulanan-yuran_bulanan2").value = yuranbulanan;
		document.getElementById("id-yuranperlubayar").value = yuranbulanan;
		var baki = document.getElementById("id-baki").value;
		//var bakiakhir = (Number(tambahan.replace(/\,/g,'')) + Number(baki.replace(/\,/g,''))) - Number(bayaran.replace(/\,/g,''));
		var bakiakhir = (Number(tambahan) + Number(baki.replace(/\,/g,''))) - Number(bayaran.replace(/\,/g,''));
		document.getElementById("yuranbulanan-baki").value = bakiakhir;
		document.getElementById("yuranbulanan-yuran_bulanan2").value = tambahan;
		//bakijs();
	}
	function bakijs(){
		//var perludibayar = document.getElementById("yuranbulanan-yuran_bulanan2").value;
		var perludibayar = document.getElementById("id-yuranperlubayar").value;
		var bayaran = document.getElementById("yuranbulanan-bayaran").value;
		var baki = document.getElementById("yuranbulanan-baki").value;
		var bakiakhir = Number(perludibayar.replace(/\,/g,'')) - Number(bayaran.replace(/\,/g,''));
		document.getElementById("yuranbulanan-baki").value = bakiakhir;
	}
	window.onload = bayaranjs;
</script>