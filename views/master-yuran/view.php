<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MasterYuran */

$this->title = $model->tahun;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-yuran-view">
	<p>
        <?= Html::a('Kemaskini', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Padam', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
    <?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			[
				'columns' => [
					[
						'attribute'=>'tahun',
						'valueColOptions'=>['style'=>'width:30%']
					],
					[
						'attribute'=>'yuran_bulanan',
						'valueColOptions'=>['style'=>'width:30%']
					],
				],
			],
			[
				'columns' => [
					[
						'attribute'=>'yatim',
						'valueColOptions'=>['style'=>'width:30%']
					],
					[
						'attribute'=>'oku',
						'valueColOptions'=>['style'=>'width:30%']
					],
				],
			],
			[
				'columns' => [
					[
						'attribute'=>'adik_beradik',
						'valueColOptions'=>['style'=>'width:30%']
					],
					[
						'attribute'=>'adikberadik_3',
						'valueColOptions'=>['style'=>'width:30%']
					],
				],
			],
			[
				'columns' => [
					[
						'attribute'=>'tuisyen',
						'valueColOptions'=>['style'=>'width:30%']
					],
					[
						'attribute'=>'makan_tuisyen',
						'valueColOptions'=>['style'=>'width:30%']
					],
				],
			],
			'makan',
		],
		'mode' => 'view',
		'enableEditMode'=>false,
		'bordered' => true,
		'striped' => false,
		'condensed' => false,
		'responsive' => true,
		'hover' => true,
		'hAlign'=>'right',
		'vAlign'=>'middle',
		'deleteOptions'=>[ // your ajax delete parameters
			'params' => ['id' => $model->id, 'kvdelete'=>true],
		],
		'panel'=>[
			'heading'=>$this->title,
			'type'=>'primary',
			'template'=>['class'=>'text-center']
		],
		'container' => ['id'=>'kv2'],
		'buttons1' => '{delete}',
	]); ?>

</div>
