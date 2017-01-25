<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MasterYuranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Master Yuran';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-yuran-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
			'dataProvider'=> $dataProvider,
			'filterModel' => $searchModel,			
			'responsiveWrap' => false,
			'columns' => [
				['class' => 'kartik\grid\SerialColumn'],
				'tahun',
				'yuran_bulanan',
				'yatim',
				'adik_beradik',
				'adikberadik_3',
				'oku',
				// 'tahun',
				// 'van',
				 'tuisyen',
				 'makan_tuisyen',
				 'makan',

				['class' => 'kartik\grid\ActionColumn']
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
		]);	
		?>
</div>
