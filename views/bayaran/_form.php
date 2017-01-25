<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Bayaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bayaran-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_pelajar')->textInput() ?>

    <?= $form->field($model, 'id_kelas')->textInput() ?>

    <?= $form->field($model, 'id_bulan')->textInput() ?>

    <?= $form->field($model, 'tarikh')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'duit_perludibayar')->textInput() ?>

    <?= $form->field($model, 'duit_terima')->textInput() ?>

    <?= $form->field($model, 'baki')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Simpan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
