<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\KelasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kelas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelas-index">

	<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            //'id',
            [ 
				'attribute'=>'tingkatan',
				'contentOptions' => ['style' => 'width:5%;'],
			],
            [
				'attribute'=>'nama_kelas',
				'value'=>function($model){
					return $model->refKelas->keterangan;
				},
				'filter' => Html::activeDropDownList($searchModel, 'nama_kelas', ArrayHelper::map(app\models\RefKelas::find()->orderBy('keterangan')->all(), 'id', 'keterangan'),['class'=>'form-control','prompt' => 'Semua'])
			],
            [
				'attribute'=>'id_sesi',
				'value'=>function($model){
					return $model->sesi->tahun;
				},
				'filter' => Html::activeDropDownList($searchModel, 'id_sesi', ArrayHelper::map(app\models\Sesi::find()->orderBy('tahun DESC')->all(), 'id', 'tahun'),['class'=>'form-control','prompt' => 'Semua'])
			],
            [
				'attribute'=>'id_guru',
				'value'=>function($model){
					return $model->guru->nama_guru;
				},
				'filterType'=>GridView::FILTER_SELECT2,
				'filter'=>ArrayHelper::map(app\models\Guru::find()->orderBy('nama_guru')->asArray()->all(), 'id', 'nama_guru'), 'filterWidgetOptions'=>[
					'pluginOptions'=>['allowClear'=>true],
				],
				'filterInputOptions'=>['placeholder'=>'Semua'],
			],

            ['class' => 'kartik\grid\ActionColumn'],
        ],
			'pjax' => false,
			'bordered' => true,
			'striped' => true,
			'condensed' => false,
			'responsive' => true,
			'hover' => true,
			'panel' => [
				'type' => GridView::TYPE_PRIMARY,
				'heading'=>'<i class="glyphicon glyphicon-book"></i> '.$this->title,
				'before'=>Html::a('Tambah Kelas', ['create'], ['class' => 'btn btn-success']),
			],
    ]); ?>
	</div>
