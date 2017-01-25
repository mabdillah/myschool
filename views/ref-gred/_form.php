<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RefGred */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-gred-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'gred')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'min_mark')->textInput() ?>

    <?= $form->field($model, 'max_mark')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Simpan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
