<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use mdm\admin\components\Helper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\GuruSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Guru';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guru-index">
 <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            // 'id_guru',
            'nama_guru',
			'ic',
			'no_tel',
			'alamat:ntext',
            ['class' => 'kartik\grid\ActionColumn',
			'noWrap'=>true,
			//'template' => Helper::filterActionColumn('{view} {update} {mp} {delete}'),
			'template' => '{view} {update} {mp} {delete}',
				'buttons' => [
					'mp' => function ($url, $model) {
						if(\Yii::$app->user->can('Admin')){
							return Html::a('<span class="glyphicon glyphicon-tasks"></span>',['mp','id'=>$model->id], [
							'title' => 'Mata Pelajaran'
						]);
						}
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
			'before'=>!\Yii::$app->user->can('Guru') ? Html::a('Tambah Guru', ['user/admin/create'], ['class' => 'btn btn-success']) : '',
			//'before'=>Html::a('Tambah Guru', ['create'], ['class' => 'btn btn-success']),
		],
    ]); ?>
	</div>
