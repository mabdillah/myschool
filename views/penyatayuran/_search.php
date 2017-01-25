<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PenyatayuranSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penyatayuran-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_penyata') ?>

    <?= $form->field($model, 'id_bulan') ?>

    <?= $form->field($model, 'yuran_belajar') ?>

    <?= $form->field($model, 'yuran_makan') ?>

    <?= $form->field($model, 'yuran_pengangkutan') ?>

    <?php // echo $form->field($model, 'yuran_tuisyen') ?>

    <?php // echo $form->field($model, 'yuran_tuisyenmakan') ?>

    <?php // echo $form->field($model, 'discount') ?>

    <?php // echo $form->field($model, 'jumlah') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
