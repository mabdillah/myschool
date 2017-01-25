<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Guru */

$this->title = $model->nama_guru;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guru-view">
    <p>
        <?= Html::a('Kemaskini', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Padam', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
	

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nama_guru',
            'ic',
            'no_tel',
            'alamat',
			[
				'label'=>'Tahun',
				'format'=>'raw',
				'value'=>'<form method="post" action="" name="myform">'. Html::hiddenInput('_csrf',Yii::$app->request->getCsrfToken()) . Html::dropDownList('tahun',$tahun,ArrayHelper::map(\app\models\Sesi::find()->orderBy('tahun')->orderBy('tahun DESC')->all(),'tahun', 'tahun' ),['class'=>'','onchange'=>"myform.submit();",'id'=>"ontahun"])."</form>",
			],
			[
				'label'=>'Mata Pelajaran',
				'format'=>'raw',
				'value'=>$model->getKelasHtml($model->id,$tahun),
			],
        ],
		'enableEditMode'=>false,
		'panel'=>[
			'heading'=>$this->title,
			'type'=>'primary',
			'template'=>['class'=>'text-center']
		],
    ]) ?>

</div>
<script>
	$(document).ready(function(){
        $('#ontahun').change(function(){
            myform.submit();
        });
    });
</script>