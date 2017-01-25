<?php

use yii\helpers\Html;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\RefGredSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gred';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-gred-index">
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'responsiveWrap' => false,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            //'id',
            'gred',
            'min_mark',
            'max_mark',

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
			'before'=>Html::a('Tambah Master Yuran', ['create'], ['class' => 'btn btn-success']),
		],
    ]); ?>
	</div>
