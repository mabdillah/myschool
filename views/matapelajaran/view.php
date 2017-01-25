<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Matapelajaran */

$this->title = $model->kod_matapelajaran;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matapelajaran-view">
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
            'kod_matapelajaran',
            'nama_matapelajaran',
        ],
		'enableEditMode'=>false,
		'panel'=>[
			'heading'=>$this->title,
			'type'=>'primary',
			'template'=>['class'=>'text-center']
		],
    ]) ?>

</div>
