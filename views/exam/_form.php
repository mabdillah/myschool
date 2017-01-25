<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Pelajar;

/* @var $this yii\web\View */
/* @var $model app\models\Exam */
/* @var $form yii\widgets\ActiveForm */
if(!$model->isNewRecord){
	$id_kelas = $model->id_kelas;
	$id_matapelajaran = $model->id_matapelajaran;
}
$query = Yii::$app->getDb()->createCommand("SELECT tahun FROM `kelas` inner join sesi on sesi.id=kelas.id_sesi WHERE kelas.`id` = '$id_kelas'")->queryOne(); 
?>

<div class="exam-form">
<div class="row">
    <?php $form = ActiveForm::begin(); ?>
	<div class="col-sm-3">
    <?= $form->field($model, 'description')->dropDownList(ArrayHelper::map(\app\models\RefExam::find()->orderBy('id')->all(),'id', 'keterangan' ),['disabled'=>$model->isNewRecord ? false : true]) ?>
	</div>
	<div class="col-sm-3">
	<?php 
	$kelas = Yii::$app->getDb()->createCommand("SELECT kelas.id,concat(kelas.tingkatan,' ',ref_kelas.keterangan) keterangan FROM `kelas` inner join ref_kelas on ref_kelas.id=kelas.nama_kelas WHERE kelas.id='$id_kelas';")->queryAll(); 
	?>
    <?= $form->field($model, 'id_kelas')->dropDownList(ArrayHelper::map($kelas,'id', 'keterangan'),['readonly'=>true]) ?>

	</div>
	<div class="col-sm-3">
		<?= $form->field($model, 'id_matapelajaran')->dropDownList(ArrayHelper::map(app\models\Matapelajaran::find()->where("id='$id_matapelajaran'")->all(),'id', 'nama_matapelajaran'),['readonly'=>true]) ?>
	</div>
	<div class="col-sm-3">
		<?= $form->field($model, 'tahun')->textInput(['value'=>$query['tahun'],'readonly'=>true]) ?>
	</div>
	<div class="clearfix"></div>
	<?php 
	if(!$model->isNewRecord){
		//echo '<div class="col-sm-12">';
		/*echo GridView::widget([
			'dataProvider' => $dataProvider,
			'columns' => [
				[ 
					'attribute'=>'id_pelajar',
					'value'=>function($model){
						return $model->pelajar->nama_pelajar;
					},
				],
				'markah1',
				'markah2',
				'gred',
			],
		]); */
		//echo '</div>';
		
		echo '<div class="col-sm-12">
		<table class="table table-hover table-bordered table-striped">
		<thead><tr><th>Pelajar</th><th>Markah 1</th><th>Markah 2</th><th>Jumlah</th><th>Gred</th></tr></thead><tbody>';
		$datam = Yii::$app->getDb()->createCommand("Select * FROM markah WHERE id_exam='". $model->id ."';")->queryAll(); 
		foreach ($datam as $datams) {
		   echo '<tr>';
		   echo '<td>'. Pelajar::getPelajarInfo('nama_pelajar',$datams['id_pelajar']).Html::hiddenInput("id[]", $datams['id_pelajar']).'</td>';
		   echo '<td>'.Html::textInput("markah1[]", $datams['markah1'],['class'=>'form-control','id'=>'markah1_'.$datams['id_pelajar'],'onkeyup'=>"kiragred(".$datams['id_pelajar'].")"]).'</td>';
		   echo '<td>'.Html::textInput("markah2[]", $datams['markah2'],['class'=>'form-control','id'=>'markah2_'.$datams['id_pelajar'],'onkeyup'=>"kiragred(".$datams['id_pelajar'].")"]).'</td>';
		   echo '<td>'.Html::textInput("jumlah[]", $datams['jumlah'],['class'=>'form-control','readonly'=>true, 'id' => 'jumlah_' . $datams['id_pelajar']]).'</td>';
		   echo '<td>'.Html::textInput("gred[]", $datams['gred'],['class'=>'form-control','readonly'=>true,'id' => 'gred_' . $datams['id_pelajar']]).'</td>';
		   echo '</tr>';
		}  
		echo '</tbody>
		</table>
		</div>';
	}
	?>
	<div class="clearfix"></div>
	<div class="col-sm-8">
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Simpan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>

<script>
	function kiragred(idpelajar){
		var markah1 = document.getElementById("markah1_"+idpelajar).value;
		var markah2 = document.getElementById("markah2_"+idpelajar).value;
		var jum = parseFloat(markah1) + parseFloat(markah2);
		if(isNaN(jum)){
			jum = markah1;
		}
		document.getElementById("jumlah_"+idpelajar).value = jum;
		$.ajax({
			type:"POST",
			url: "gred?val="+jum,
			success: function(response){
				//alert(response);
				document.getElementById("gred_"+idpelajar).value = response;
			}
		});
	}
</script>
