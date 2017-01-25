<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Markah */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="markah-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_pelajar')->textInput() ?>

    <?= $form->field($model, 'id_exam')->textInput() ?>

    <?= $form->field($model, 'markah1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'markah2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jumlah')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gred')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Simpan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
