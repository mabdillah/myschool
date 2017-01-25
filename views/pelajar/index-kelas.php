<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PelajarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kelas Pelajar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pelajar-index">

    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
	<?=Html::beginForm(['pelajar-kelas/bulk'],'post');?>
	<?= GridView::widget([
			'dataProvider'=> $dataProvider,
			'filterModel' => $searchModel,
			'responsiveWrap' => false,
			'columns' => [
				['class' => 'kartik\grid\SerialColumn'],
				[
					'class'=>'kartik\grid\CheckboxColumn',
					'headerOptions'=>['class'=>'kartik-sheet-style'],
					//'hidden'=>true
				],
				'nama_pelajar',
				[
					'attribute'=>'jantina',
					'format'=>'raw',
					'filter' => Html::activeDropDownList($searchModel, 'jantina', ['L'=>'Lelaki','P'=>'Perempuan'],['class'=>'form-control','prompt' => 'Semua']),
					'value'=> function ($model) {
						return $model->jantina=='L'?"Lelaki":"Perempuan";
					},
				],
				'no_mykid',
				'no_sijilLahir',
				/*[
					'attribute'=> 'id_status',
					'value'=>function($model){
						return $model->status1->keterangan;
					},
					'filter' => Html::activeDropDownList($searchModel, 'id_status', ArrayHelper::map(app\models\Status::find()->asArray()->orderBy('keterangan')->all(), 'id_status', 'keterangan'),['class'=>'form-control','prompt' => 'Semua']),
				],*/
				/*['class' => 'kartik\grid\ActionColumn',
					'template' => '{delete}',
					'buttons' => [
						'delete' => function ($url, $model,$key) {
							$idpelajarkelas = '';
							return Html::a('<span class="glyphicon glyphicon-trash"></span>',['pelajar-kelas/padam','id'=>$idpelajarkelas], [
								'title' => 'Padam','data-confirm'=>"Adakah anda pasti untuk menghapuskan item ini?",'data-method'=>"post"
							]);
						},
					],
				],*/
			],
			//'pjax' => false,
			//'bordered' => true,
			//'striped' => true,
			//'condensed' => false,
			//'responsive' => true,
			//'hover' => true,	
			'panel' => [
				'type' => GridView::TYPE_PRIMARY,
				'heading'=>'<i class="glyphicon glyphicon-book"></i> '.$this->title,
				'after'=>Html::submitButton('Hantar', ['class' => 'btn btn-primary'])
			],
			'toolbar'=>[
				//'{export}',
				'{toggleData}'
			]
		]);
        ?>
		</div>
	<?=Html::endForm();?>
