<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\RefRumahsukanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rumah Sukan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-rumahsukan-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'responsiveWrap' => false,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            //'id',
            'keterangan',

            ['class' => 'kartik\grid\ActionColumn'],
        ],
			'pjax' => true,
			'bordered' => true,
			'striped' => true,
			'condensed' => false,
			'responsive' => true,
			'hover' => true,
			 		
			'panel' => [
				'type' => GridView::TYPE_PRIMARY,
				'heading'=>'<i class="glyphicon glyphicon-book"></i> '.$this->title,
				'before'=>Html::a('Tambah Rumah Sukan', ['create'], ['class' => 'btn btn-success']),
			],
		]);
		?>
</div>
