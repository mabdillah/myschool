<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Kelas */

$this->title = $model->refKelas->keterangan;
$this->params['breadcrumbs'][] = ['label' => 'Kelas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>

<div class="kelas-view">
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
            'tingkatan',
			[
				'attribute'=>'nama_kelas',
				'value'=>$model->refKelas->keterangan
			],
			[
				'attribute'=>'id_sesi',
				'value'=>$model->sesi->tahun
			],
			[
				'attribute'=>'id_guru',
				'value'=>$model->guru->nama_guru
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
