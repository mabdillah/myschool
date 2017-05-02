<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\SumbanganSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sumbangan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sumbangan-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
		'responsiveWrap' => false,
        'filterModel' => $searchModel,
		'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            [
				'attribute'=>'nama',
				'contentOptions' => ['style' => 'width:40%; '],
			],
            [
				'attribute'=>'id_jenissumbangan',
				'contentOptions' => ['style' => 'width:14%; '],
				'filterType'=>GridView::FILTER_SELECT2,
				'filter'=>ArrayHelper::map(app\models\RefJenissumbangan::find()->orderBy('keterangan')->all(), 'id', 'keterangan'), 
				'filterWidgetOptions'=>[
					'pluginOptions'=>['allowClear'=>true],
				],
				'filterInputOptions'=>['placeholder'=>'Semua'],
				'value'=>function($model){
					return $model->jenissumbangan->keterangan;
				}
			],
            [ 
				'attribute'=>'tarikh_sumbangan',
				'value'=>function($model){
					return $model->tarikh_sumbangan;
				},
				'format' =>  ['date'],
				'contentOptions' => ['style' => 'width:14%; '],
			],
			[ 
				'attribute'=>'jumlah',
				'contentOptions' => ['style' => 'width:14%; '],
			],
            ['class' => 'kartik\grid\ActionColumn',
				'contentOptions' => ['style' => 'width:20%;'],
				'template'=>'{view} {update} {print} {delete}',
				'buttons' => [
					'print' => function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-print"></span>',['surat/sumbangan','id'=>$model->id], [
							'title' => 'Print'
						]);
					},
				],
			],
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
			'before'=>Html::a('Tambah Sumbangan', ['create'], ['class' => 'btn btn-success']),
		],
    ]); ?>
</div>
