<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RefLokaliti */

$this->title = $model->Nama_Lokaliti;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-lokaliti-view">
    <p>
        <?= Html::a('Kemaskini', ['update', 'id' => $model->REC_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Padam', ['delete', 'id' => $model->REC_ID], [
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
            //'REC_ID',
            //'Kod_Negeri',
            //'Kod_Parlimen',
            //'Kod_DUN',
            //'Kod_Daerah',
            //'Kod_Lokaliti',
            'Nama_Lokaliti',
            'harga_van',
            'harga_van2',
        ],
		'enableEditMode'=>false,
		'panel'=>[
			'heading'=>$this->title,
			'type'=>'primary',
			'template'=>['class'=>'text-center']
		],
    ]) ?>

</div>
