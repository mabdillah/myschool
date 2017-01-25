<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SesiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sesi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sesi-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?=  GridView::widget([
			'dataProvider'=> $dataProvider,
			'filterModel' => $searchModel,
			'columns' => [
				['class' => 'kartik\grid\SerialColumn'],
				'tahun',
				'tarikh_mula:date',
				'tarikh_tamat:date',

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
				'before'=>Html::a('Tambah Sesi', ['create'], ['class' => 'btn btn-success']),
			],
		]);	
	?>
	
	</div>
