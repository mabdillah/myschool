<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\search\PelajarKelasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pelajar-kelas-search">
<div class="row">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
		//'type' => ActiveForm::TYPE_INLINE,
    ]); ?>
	<!--
	<div class="col-sm-4">
		<?php //= $form->field($model, 'id_sesi')->widget(Select2::classname(),['data' => ArrayHelper::map(\app\models\Sesi::find()->orderBy('tahun')->all(),'id', 'tahun' ),'pluginOptions'=>['allowClear'=>true],'options' => ['placeholder' => 'Sila Pilih',]]) ?>
	</div>
	<div class="col-sm-4">
		<?php //= $form->field($model, 'tingkatan')->dropdownList([1=>1,2=>2,3=>3,4=>4,5=>5],['prompt'=>'Sila Pilih']) ?>
	</div>
	<div class="col-sm-4">
		<?php //= $form->field($model, 'nama_kelas')->widget(Select2::classname(),['data' => ArrayHelper::map(\app\models\RefKelas::find()->orderBy('keterangan')->all(),'id', 'keterangan' ),'pluginOptions'=>['allowClear'=>true],'options' => ['placeholder' => 'Sila Pilih',]]) ?>
	</div>
	-->
	<div class="col-sm-4">
	<?php 
		if(\Yii::$app->user->can('Guru')){
			$datakelas = Yii::$app->getDb()->createCommand("SELECT kelas.id,concat(tingkatan,' - ',keterangan,' (',tahun,')') kelasinfo FROM `kelas` inner join sesi on kelas.id_sesi = sesi.id inner join ref_kelas on nama_kelas=ref_kelas.id WHERE id_guru IN (select id from guru where id_guru = '". Yii::$app->user->id ."') ORDER by tahun,tingkatan ASC")->queryAll();
		}else{
			$datakelas = Yii::$app->getDb()->createCommand("SELECT kelas.id,concat(tingkatan,' - ',keterangan,' (',tahun,')') kelasinfo FROM `kelas` inner join sesi on kelas.id_sesi = sesi.id inner join ref_kelas on nama_kelas=ref_kelas.id ORDER BY tahun DESC,tingkatan ASC")->queryAll();
		}
		
		echo $form->field($model, 'id_kelas')->widget(Select2::classname(),[
			'data' => ArrayHelper::map($datakelas,'id', 'kelasinfo'),'pluginOptions'=>['allowClear'=>true],
			'options' => ['placeholder' => 'Carian Kelas ... '],
		])->label(false);
	?>
	
	</div>
	<!-- <div class="clearfix"></div> -->
	
	<div class="col-sm-4">
		<div class="form-group"> 
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?php //= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		 </div> 
    <?php ActiveForm::end(); ?>
	</div>

</div>
</div>
