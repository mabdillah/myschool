<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\RefExamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Peperiksaan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-exam-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

           // 'id',
            'keterangan',

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
			'before'=>Html::a('Tambah Peperiksaan', ['create'], ['class' => 'btn btn-success']),
		],
    ]); ?>
</div>
