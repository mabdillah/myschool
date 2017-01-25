<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RefGred */

$this->title = $model->gred;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-gred-view">
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
            'gred',
            'min_mark',
            'max_mark',
        ],
		'enableEditMode'=>false,
		'panel'=>[
			'heading'=>$this->title,
			'type'=>'primary',
			'template'=>['class'=>'text-center']
		],
    ]) ?>

</div>
