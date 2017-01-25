<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RefKaum */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-kaum-form">
<div class="row">
    <?php $form = ActiveForm::begin(); ?>
<div class="col-sm-4">
    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>
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
