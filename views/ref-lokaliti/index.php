<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RefLokalitiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Harga Van';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-lokaliti-index">

	<?php //echo $this->render('_search', ['model' => $searchModel]); ?>
	<?= GridView::widget([
			'dataProvider'=> $dataProvider,
			'filterModel' => $searchModel,
			'responsiveWrap' => false,
			'columns' => [
				['class' => 'kartik\grid\SerialColumn'],
				'Nama_Lokaliti',
				'harga_van',
				'harga_van2',
				['class' => 'kartik\grid\ActionColumn']
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
				'before'=>Html::a('Tambah Harga Van', ['create'], ['class' => 'btn btn-success']),
			],
		]);	
		?>

</div>
