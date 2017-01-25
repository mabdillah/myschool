<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PelajarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kelas Pelajar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pelajar-index">
<div class="row">
	<div class="panel panel-primary">
			<div class="panel-heading">
				<?= Html::encode($this->title) ?>
			</div>
			<div class="panel-body">
				<?php $form = ActiveForm::begin(); ?>
				<div class="col-sm-4">
				<?php 
				if(\Yii::$app->user->can('Guru')){
					$datakelas = Yii::$app->getDb()->createCommand("SELECT kelas.id,concat(tingkatan,' - ',keterangan,' (',tahun,')') kelasinfo FROM `kelas` inner join sesi on kelas.id_sesi = sesi.id inner join ref_kelas on nama_kelas=ref_kelas.id WHERE id_guru IN (select id from guru where id_guru = '". Yii::$app->user->id ."') AND tahun >= YEAR(CURDATE()) ORDER by tahun,tingkatan ASC")->queryAll();
				}else{
					$datakelas = Yii::$app->getDb()->createCommand("SELECT kelas.id,concat(tingkatan,' ',keterangan,' - ',tahun) kelasinfo FROM `kelas` inner join sesi on kelas.id_sesi = sesi.id inner join ref_kelas on nama_kelas=ref_kelas.id WHERE tahun >= YEAR(CURDATE()) order by tahun,tingkatan ASC")->queryAll();
				}
				?>
				<?= $form->field($model, 'id_kelas')->widget(Select2::classname(),['data' => ArrayHelper::map($datakelas,'id', 'kelasinfo'),'pluginOptions'=>['allowClear'=>true],'options' => ['placeholder' => 'Carian',]])->label('Kelas Baru') ?>
				</div>
				<div class="clearfix"></div>
				<div class="col-sm-8">
				<?= GridView::widget([
						'dataProvider'=> $dataProvider,
						'columns' => [
							['class' => 'kartik\grid\SerialColumn'],
							'nama_pelajar',
							[
								'class' => 'kartik\grid\CheckboxColumn',
								'checkboxOptions' => function ($model) {
									return ['value' => $model->id,'checked' => true];
								}
							],
						],
					]);
					?>
				</div>
				<div class="col-sm-8">
					<div class="form-group">
						<?= Html::submitButton('Simpan' , ['class' =>'btn btn-success']) ?>
					</div>
				</div>
				
				<?php ActiveForm::end(); ?>
			</div>
	</div>
</div>
</div>