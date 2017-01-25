<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\RefKaumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kaum';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kaum-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'responsiveWrap' => false,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
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
			'before'=>Html::a('Tambah Kaum', ['create'], ['class' => 'btn btn-success']),
		],
    ]); ?>
</div>
