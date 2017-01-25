<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PelajarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Markah';
$this->params['breadcrumbs'][] = $this->title;

//echo '+'.$tahun;
$sqlbilkertas = Yii::$app->getDb()->createCommand("SELECT count(*) bil FROM `exam` WHERE tahun='$tahun' AND description='$periksa' group by id_kelas,tahun,description;")->queryOne();
$bilkertas = $sqlbilkertas['bil'];


?>
<div class="pelajar-index">

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
	<?=Html::beginForm(['pelajar-kelas/bulk'],'post');?>
	<?= GridView::widget([
			'dataProvider'=> $dataProvider,
			'filterModel' => $searchModel,
			'responsiveWrap' => false,
			'columns' => [
				['class' => 'kartik\grid\SerialColumn'],
				[
					'attribute'=>'id_pelajar',
					'value'=>function ($model){
						return $model->pelajar->nama_pelajar;
					},
					'filterType'=>GridView::FILTER_SELECT2,
					'filter'=>ArrayHelper::map(app\models\Pelajar::find()->orderBy('nama_pelajar')->all(), 'id', 'nama_pelajar'), 
					'filterWidgetOptions'=>[
						'pluginOptions'=>['allowClear'=>true],
					],
					'filterInputOptions'=>['placeholder'=>'Semua'],
				],
				[
					'label'=>'Jantina',
					'value'=>function ($model){
						$jantina = ['L'=>'Lelaki','P'=>'Perempuan',''=>''];
						return $jantina[$model->pelajar->jantina];
					}
				],
				[
					'label'=>'Jumlah Markah',
					'value'=>'jumMarkah',
				],
				[
					'label'=>'% Markah',
					'value'=>function($model, $key, $index, $column)  use ($bilkertas) {
						if($bilkertas>0){
							$pcent = round((($model->jumMarkah/($bilkertas*100))*100),2);
						}else{
							$pcent = 0;
						}
						return $pcent;
					}
				],
				[
					'label'=>'Kelas',
					'value'=>function($model) use ($tahun){
						$kelas = Yii::$app->getDb()->createCommand("SELECT tingkatan,ref_kelas.keterangan FROM `pelajar_kelas` inner join kelas on kelas.id=pelajar_kelas.id_kelas inner join ref_kelas on ref_kelas.id=kelas.nama_kelas where kelas.id_sesi = (select id from sesi where tahun='".$tahun."') and pelajar_kelas.id_pelajar='".$model->id_pelajar ."'")->queryOne();
						return $kelas['tingkatan'].' '.$kelas['keterangan'];
					}
				],
				/*[
					'attribute'=>'jantina',
					'format'=>'raw',
					'filter' => Html::activeDropDownList($searchModel, 'jantina', ['L'=>'Lelaki','P'=>'Perempuan'],['class'=>'form-control','prompt' => 'Semua']),
					'value'=> function ($model) {
						return $model->jantina=='L'?"Lelaki":"Perempuan";
					},
				],
				'no_mykid',
				'no_sijilLahir',
				*/
			],
			//'pjax' => false,
			//'bordered' => true,
			//'striped' => true,
			//'condensed' => false,
			//'responsive' => true,
			//'hover' => true,	
			'panel' => [
				'type' => GridView::TYPE_PRIMARY,
				'heading'=>'<i class="glyphicon glyphicon-book"></i> '.$this->title,
				//'after'=>Html::submitButton('Hantar', ['class' => 'btn btn-primary'])
			],
			'toolbar'=>[
				//'{export}',
				'{toggleData}'
			]
		]);
        ?>
		</div>
	<?=Html::endForm();?>
