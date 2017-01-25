<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\YuranSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="yuran-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_yuran') ?>

    <?= $form->field($model, 'id_pelajar') ?>

    <?= $form->field($model, 'id_kelas') ?>

    <?= $form->field($model, 'id_bulan') ?>

    <?= $form->field($model, 'yuran_pelajaran') ?>

    <?php // echo $form->field($model, 'baki_yuran_pelajaran') ?>

    <?php // echo $form->field($model, 'yuran_makan') ?>

    <?php // echo $form->field($model, 'baki_yuran_makan') ?>

    <?php // echo $form->field($model, 'yuran_pengangkutan') ?>

    <?php // echo $form->field($model, 'baki_yuran_pengangkutan') ?>

    <?php // echo $form->field($model, 'yuran_tuisyen') ?>

    <?php // echo $form->field($model, 'baki_yuran_tuisyen') ?>

    <?php // echo $form->field($model, 'yuran_tuisyen_makan') ?>

    <?php // echo $form->field($model, 'baki_yuran_tuisyen_makan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
