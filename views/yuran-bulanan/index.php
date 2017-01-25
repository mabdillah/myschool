<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Pelajar;

/* @var $this yii\web\View */
/* @var $searchModel app\models\YuranBulananSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transaksi Bayaran';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yuran-bulanan-index">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'responsiveWrap' => false,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            //'id',
            'tarikh_dicipta:datetime',
            [	
				'attribute'=>'pelajar_id',
				'value'=>function ($model){
					return $model->pelajar->nama_pelajar;
				},
				'filterType'=>GridView::FILTER_SELECT2,
				'filter'=>ArrayHelper::map(Pelajar::find()->orderBy('nama_pelajar')->all(), 'id', 'nama_pelajar'), 
				'filterWidgetOptions'=>[
					'pluginOptions'=>['allowClear'=>true],
				],
				'filterInputOptions'=>['placeholder'=>'Semua'],
				'label'=>'Pelajar'
			],
            //'bulan_tahun',
            //'yuran_bulanan',
            //'van',
            // 'tuisyen',
            // 'makan',
            // 'bayaran',
            // 'baki',
            [	
				'attribute'=>'catatan2',
				'pageSummary'=>'Jumlah: ',
				'pageSummaryOptions'=>['class'=>'text-right text-warning'],
			],
            [
				'attribute'=>'bayaran',
				'format'=>['decimal', 2],
				'pageSummary'=>true,
			],
            //['class' => 'kartik\grid\ActionColumn'],
        ],
		'showPageSummary' => true,
		'pjax' => false,
		'bordered' => true,
		'striped' => true,
		'condensed' => false,
		'responsive' => true,
		'hover' => true,	
		'panel' => [
			'type' => GridView::TYPE_PRIMARY,
			'heading'=>'<i class="glyphicon glyphicon-book"></i> '.$this->title,
		],
    ]); ?>
</div>
