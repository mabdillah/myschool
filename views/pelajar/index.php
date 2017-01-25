<?php

use yii\helpers\Html;
use kartik\grid\GridView;
//use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PelajarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pelajar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pelajar-index">

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
	<?= GridView::widget([
			'dataProvider'=> $dataProvider,
			'filterModel' => $searchModel,
			'responsiveWrap' => false,
			'columns' => [
				['class' => 'kartik\grid\SerialColumn'],
				'nama_pelajar',
				[
					'attribute'=>'jantina',
					'format'=>'raw',
					'filter' => Html::activeDropDownList($searchModel, 'jantina', ['L'=>'Lelaki','P'=>'Perempuan'],['class'=>'form-control','prompt' => 'Semua']),
					'value'=> function ($model) {
						return $model->jantina=='L'?"Lelaki":"Perempuan";
					},
				],
				'no_mykid',
				'no_sijilLahir',
				[
					'attribute'=> 'id_status',
					'value'=>function($model){
						return $model->status1->keterangan;
					},
					'filter' => Html::activeDropDownList($searchModel, 'id_status', ArrayHelper::map(app\models\Status::find()->asArray()->orderBy('keterangan')->all(), 'id_status', 'keterangan'),['class'=>'form-control','prompt' => 'Semua']),
				],
				[
					'label'=>'Kelas',
					'value'=>function($model) use ($tahun){
						$kelas = Yii::$app->getDb()->createCommand("SELECT kelas.id,tingkatan,ref_kelas.keterangan FROM `pelajar_kelas` inner join kelas on kelas.id=pelajar_kelas.id_kelas inner join ref_kelas on ref_kelas.id=kelas.nama_kelas where kelas.id_sesi = (select id from sesi where tahun=YEAR(curdate())) and pelajar_kelas.id_pelajar='".$model->id ."'")->queryOne();
						if($kelas['id']>0){
							return $kelas['tingkatan'].' '.$kelas['keterangan'];
						}else{
							$kelaslast = Yii::$app->getDb()->createCommand("SELECT sesi.tahun,tingkatan,ref_kelas.keterangan FROM `pelajar_kelas` inner join kelas on kelas.id=pelajar_kelas.id_kelas inner join ref_kelas on ref_kelas.id=kelas.nama_kelas inner join sesi on sesi.id=kelas.id_sesi where pelajar_kelas.id_pelajar='".$model->id."' order by pelajar_kelas.id desc limit 1")->queryOne();
							return $kelaslast['tingkatan'].' '.$kelaslast['keterangan'].' ('.$kelaslast['tahun'].')';
						}
					}
				],
				// 'sesi',
				// 'pelajarKelas.id_pelajar',
				// 'alamat',
				// 'poskod',
				// 'daerah',
				// 'negeri',
				// 'nama_bapa',
				// 'no_mykadBapa',
				// 'pekerjaan_bapa',
				// 'no_telBapa',
				// 'nama_ibu',
				// 'no_mykadIbu',
				// 'pekerjaan_ibu',
				// 'no_telIbu',
				// 'status_yatim',
				// 'status_OKU',
				// 'warganegara',
				// 'kaum',
				// 'badan_beruniform',
				// 'persatuan',
				// 'sukan',
				// 'catatan',

				['class' => 'kartik\grid\ActionColumn',
				'noWrap'=>true,
					'template' => '{view} {update} {yuran} {delete}',
					'buttons' => [
						'yuran' => function ($url, $model) {
							if($model->id_status == 1){
								return Html::a('<span class="glyphicon glyphicon-usd"></span>',['yuran-bulanan/view','pelajar_id'=>$model->id], [
								'title' => 'yuran bulanan'
							]);
							}else{
								return false;
							}
						},
					],
				],
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
				'before'=>Html::a('Tambah Pelajar', ['create'], ['class' => 'btn btn-success']),
			],
		]);
        ?>
		</div>
