<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PelajarKelasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pelajar Kelas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pelajar-kelas-index">

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
	<?php echo Html::beginForm(['bulk'],'post',['id'=>'aaa']);?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            [
				'class' => 'kartik\grid\CheckboxColumn',
				'checkboxOptions' => function ($model) {
					return ['value' => $model->id_pelajar];
				}
			],
			
            [
				'attribute'=>'id_pelajar',
				'value'=>function ($model){
					return $model->pelajar->nama_pelajar;
				}
			],
            [
				'label'=>'No Mykid',
				'value'=>function ($model){
					return $model->pelajar->no_mykid;
				}
			],
            [
				'label'=>'No Sijil Lahir',
				'value'=>function ($model){
					return $model->pelajar->no_sijilLahir;
				}
			],

            ['class' => 'kartik\grid\ActionColumn','template'=>'{delete}']
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
			'after'=>Html::submitButton('Hantar', ['class' => 'btn btn-primary'])
		],
		'toolbar'=>[
			//'{export}',
			'{toggleData}'
		]
    ]); ?>
</div>
	<?php echo Html::endForm();?>
