<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\PelajarKelas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pelajar-kelas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php 
	if($id_kelas>0){
		$model->id_kelas = $id_kelas;
	}
	if(\Yii::$app->user->can('Guru')){
		$datakelas = Yii::$app->getDb()->createCommand("SELECT kelas.id,concat(tingkatan,' - ',keterangan,' (',tahun,')') kelasinfo FROM `kelas` inner join sesi on kelas.id_sesi = sesi.id inner join ref_kelas on nama_kelas=ref_kelas.id WHERE id_guru IN (select id from guru where id_guru = '". Yii::$app->user->id ."') AND tahun >= YEAR(CURDATE()) ORDER by tahun,tingkatan ASC")->queryAll();
	}else{
		$datakelas = Yii::$app->getDb()->createCommand("SELECT kelas.id,concat(tingkatan,' ',keterangan,' - ',tahun) kelasinfo FROM `kelas` inner join sesi on kelas.id_sesi = sesi.id inner join ref_kelas on nama_kelas=ref_kelas.id WHERE tahun >= YEAR(CURDATE()) order by tahun,tingkatan ASC")->queryAll();
	}
	?>
	<div class="col-sm-8">
	<?= $form->field($model, 'id_kelas')->widget(Select2::classname(),
		[
			'data' => ArrayHelper::map($datakelas,'id', 'kelasinfo'),
			'pluginOptions'=>[
				'allowClear'=>true
			],
			'options' => [
				'placeholder' => 'Carian Kelas'
			],
			'disabled'=>$id_kelas > 0 ? true : false
		])->label('Kelas Baru') ?>
	</div>

	<div class="clearfix"></div>
	<div class="col-sm-8">
	<?php 
	if($id_kelas>0){
		echo $form->field($model, 'id_pelajar')->widget(Select2::classname(),['data' => ArrayHelper::map(app\models\Pelajar::find()->select(['id','concat(nama_pelajar," ",no_mykid) as value'])->asArray()->orderBy('nama_pelajar')->where(['id_status' => 1])->all(), 'id', 'value'), 'pluginOptions'=>['allowClear'=>true],'options' => ['placeholder' => 'Carian Pelajar']]);
	?>
	</div>
	<div class="clearfix"></div>
	<div class="col-sm-8">
		<button style="float:left;background-color: #286090;border-color: #204d74;" id="refresh_pelajar" class="btn" type="button"><font color=white>+ Tambah pelajar ke senarai dibawah</font></button><br/><br/>
	</div>
	<div class="clearfix"></div>
	<div class="col-sm-8">
		<div id="pelajar"></div>
	</div>
	<?php 
	}
	?>
	<div class="clearfix"></div>
    <div class="form-group">
        <?php 
		if($id_kelas>0){
			//do nothing
		}else{
			echo Html::submitButton($model->isNewRecord ? 'Seterusnya' : 'Simpan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
		}
		?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
	if($id_kelas>0){
	$this->registerJs('$("#refresh_pelajar").click(function(){
		$("#pelajar").html("loading..."),
				$.ajax({url: "viewpelajar?pelajar="+ $("#pelajarkelas-id_pelajar").val() +"&id_kelas=" + $("#pelajarkelas-id_kelas").val() , success: function(result){
				$("#pelajar").html(result);
				}}),
				
				$("#pelajar").on("click",".buang", function(){
					$("#pelajar").html("loading..."),
					$.ajax({url: "deletepelajar?id="+ $(this).attr("buangid") +"&id_kelas="+ $("#pelajarkelas-id_kelas").val(), success: function(result){
					$("#pelajar").html(result);
					}});
				});
		$("#catatan-id").val("");
	});
			//load kumpulan
			$( document ).ready(function() {
				$("#pelajar").html("loading..."),
				$.ajax({url: "viewpelajar?id_kelas="+ $("#pelajarkelas-id_kelas").val() , success: function(result){
				$("#pelajar").html(result);
				}}),
				
				$("#pelajar").on("click",".buang", function(){
				$("#pelajar").html("loading..."),
				$.ajax({url: "deletepelajar?id="+ $(this).attr("buangid") +"&id_kelas="+ $("#pelajarkelas-id_kelas").val(), success: function(result){
				$("#pelajar").html(result);
				}});
				});
			});
			//delete
			$("#pelajar").on("click",".buang", function(){
				$("#pelajar").html("loading..."),
				$.ajax({url: "deletepelajar?id=" + $(this).attr("buangid") +"&id_kelas="+ $("#pelajarkelas-id_kelas").val(), success: function(result){
				$("#pelajar").html(result);
				}});
			});
		');
	}
?>