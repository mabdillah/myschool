<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

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
	<div class="col-sm-2">
    <?php echo $form->field($model, 'darjah')->dropdownlist([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6],['prompt'=>'Sila Pilih']); ?>
	</div>
	<div class="col-sm-2">
	<?php 
	//$datakelas = Yii::$app->getDb()->createCommand("SELECT kelas.id,concat(tingkatan,' ',keterangan,' - ',tahun) kelasinfo FROM `kelas` inner join sesi on kelas.id_sesi = sesi.id inner join ref_kelas on nama_kelas=ref_kelas.id order by tahun DESC,tingkatan ASC,keterangan ASC")->queryAll();
	echo $form->field($model, 'kelas')->widget(Select2::classname(),
		[
			'data' => ArrayHelper::map(app\models\RefKelas::find()->orderBy('keterangan')->all(),'id', 'keterangan' ),
			'pluginOptions'=>[
				'allowClear'=>true
			],
			'options' => [
				'placeholder' => 'Semua'
			],
		]);
	?>
	</div>
	<div class="col-sm-2">
    <?= $form->field($model, 'tahun')->dropdownlist(yii\helpers\ArrayHelper::map(app\models\sesi::find()->orderby('tahun DESC')->all(),'tahun', 'tahun'),['prompt'=>'Sila Pilih']); ?>
	</div>
	<div class="col-sm-2">
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
