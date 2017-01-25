<?php

use yii\helpers\Html;
use kartik\detail\DetailView;


/* @var $this yii\web\View */
/* @var $model app\models\Pelajar */

$this->title = $model->nama_pelajar;
$this->params['breadcrumbs'][] = ['label' => 'Pelajar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pelajar-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
				'group'=>true,
				'label'=>'Peribadi',
				'rowOptions'=>['class'=>'success'],
			],
			[
				'columns' => [
					[
						'attribute'=>'nama_pelajar',
						'valueColOptions'=>['style'=>'width:30%']
					],
					[
						'attribute'=>'no_mykid',
						'valueColOptions'=>['style'=>'width:30%']
					],
				],
			],
			[
				'columns' => [
					[
						'attribute'=>'no_sijilLahir',
						'valueColOptions'=>['style'=>'width:30%']
					],
					[
						'attribute'=>'alamat',
						'valueColOptions'=>['style'=>'width:30%']
					],
				],
			],
			[
				'columns' => [
					[
						'attribute'=>'alamat2',
						'valueColOptions'=>['style'=>'width:30%']
					],
					[
						'attribute'=>'poskod',
						'valueColOptions'=>['style'=>'width:30%']
					],
				],
			],
			[
				'columns' => [
					[
						'attribute'=>'daerah',
						'valueColOptions'=>['style'=>'width:30%']
					],
					[
						'attribute'=>'negeri',
						'valueColOptions'=>['style'=>'width:30%']
					],
				],
			],
			[
				'columns' => [
					[
						'attribute'=>'jantina',
						'value'=>$model->jantina=='L' ? 'Lelaki' : 'Perempuan',
						'valueColOptions'=>['style'=>'width:30%']
					],
					[
						'attribute'=>'kaum',
						'value'=>$model->refKaum->keterangan,
						'valueColOptions'=>['style'=>'width:30%']
					],
				],
			],
			[
				'columns' => [
					[
						'attribute'=>'warganegara',
						'value'=>$model->refWarganegara->keterangan,
						'valueColOptions'=>['style'=>'width:30%']
					],
					[
						'attribute'=>'status_yatim',
						'value'=>$model->refYatim->statusyatim,
						'valueColOptions'=>['style'=>'width:30%']
					],
				],
			],
			[
				'columns' => [
					[
						'attribute'=>'status_OKU',
						'value'=>$model->refOku->statusoku,
						'valueColOptions'=>['style'=>'width:30%']
					],
					[
						'attribute'=>'id_status',
						'value'=>$model->status1->keterangan,
						'valueColOptions'=>['style'=>'width:30%']
					],
				],
			],
			'catatan',
			[
				'group'=>true,
				'label'=>'Ibu Bapa',
				'rowOptions'=>['class'=>'success'],
			],
			[
				'columns' => [
					[
						'attribute'=>'nama_bapa',
						'valueColOptions'=>['style'=>'width:30%']
					],
					[
						'attribute'=>'no_mykadBapa',
						'valueColOptions'=>['style'=>'width:30%']
					],
				],
			],
			[
				'columns' => [
					[
						'attribute'=>'pekerjaan_bapa',
						'valueColOptions'=>['style'=>'width:30%']
					],
					[
						'attribute'=>'no_telBapa',
						'valueColOptions'=>['style'=>'width:30%']
					],
				],
			],
			[
				'columns' => [
					[
						'attribute'=>'nama_ibu',
						'valueColOptions'=>['style'=>'width:30%']
					],
					[
						'attribute'=>'no_mykadIbu',
						'valueColOptions'=>['style'=>'width:30%']
					],
				],
			],
			[
				'columns' => [
					[
						'attribute'=>'pekerjaan_ibu',
						'valueColOptions'=>['style'=>'width:30%']
					],
					[
						'attribute'=>'no_telIbu',
						'valueColOptions'=>['style'=>'width:30%']
					],
				],
			],
			[
				'group'=>true,
				'label'=>'Kokurikulum',
				'rowOptions'=>['class'=>'success'],
			],
			[
				'columns' => [
					[
						'attribute'=>'badan_beruniform',
						'value'=>$model->refBadanberuniform->keterangan,
						'valueColOptions'=>['style'=>'width:30%']
					],
					[
						'attribute'=>'persatuan',
						'value'=>$model->refPersatuan->keterangan,
						'valueColOptions'=>['style'=>'width:30%']
					],
				],
			],
			[
				'attribute'=>'rumah_sukan',
				'value'=>$model->refRumahsukan->keterangan,
				'valueColOptions'=>['style'=>'width:80%']
			],
			[
				'group'=>true,
				'label'=>'Kelas',
				'rowOptions'=>['class'=>'success'],
			],
			[
				'label'=>'Kelas',
				'format'=>'raw',
				'value'=>$model->getListKelas($model->id),
				'valueColOptions'=>['style'=>'width:80%']
			],
        ],
		'enableEditMode'=>false,
		'panel'=>[
			'heading'=>$this->title,
			'type'=>'primary',
			'template'=>['class'=>'text-center']
		],
    ]) ?>

</div>
