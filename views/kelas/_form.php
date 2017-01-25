<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;
//$id_guru=Yii::$app->getRequest()->getQueryParam('guru_id') ? Yii::$app->getRequest()->getQueryParam('guru_id') : $model->id_guru;

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
?>

<div class="kelas-form">
<div class="row">
    <?php $form = ActiveForm::begin(['enableClientScript' =>false]); ?>
	<div class="col-sm-4">
    <?= $form->field($model, 'id_sesi')->widget(Select2::classname(),['data' => ArrayHelper::map(\app\models\Sesi::find()->orderBy('tahun')->orderBy('tahun DESC')->all(),'id', 'tahun' ),'pluginOptions'=>['allowClear'=>true],'options' => ['placeholder' => 'Sila Pilih',]]) ?>
	</div>
	<div class="clearfix"></div>
	<div class="col-sm-4">
    <?= $form->field($model, 'tingkatan')->dropdownList([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6],['prompt'=>'Sila Pilih']) ?>
	</div>
	<div class="clearfix"></div>
	<div class="col-sm-4">
    <?= $form->field($model, 'nama_kelas')->widget(Select2::classname(),['data' => ArrayHelper::map(\app\models\RefKelas::find()->orderBy('keterangan')->all(),'id', 'keterangan' ),'pluginOptions'=>['allowClear'=>true],'options' => ['placeholder' => 'Sila Pilih',]]) ?>
	</div>
	<div class="clearfix"></div>
	<div class="col-sm-4">
    <?= $form->field($model, 'id_guru')->widget(Select2::classname(),['data' => ArrayHelper::map(\app\models\Guru::find()->orderBy('nama_guru')->all(),'id', 'nama_guru' ),'pluginOptions'=>['allowClear'=>true],'options' => ['placeholder' => 'Sila Pilih',]]) ?>
	</div>
	<div class="clearfix"></div>
	<div class="col-sm-8">
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Kemaskini', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
