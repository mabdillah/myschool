<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MasterYuranSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="master-yuran-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'yuran_bulanan') ?>

    <?= $form->field($model, 'yatim') ?>

    <?= $form->field($model, 'adik_beradik') ?>

    <?= $form->field($model, 'oku') ?>

    <?php // echo $form->field($model, 'tahun') ?>

    <?php // echo $form->field($model, 'van') ?>

    <?php // echo $form->field($model, 'tuisyen') ?>

    <?php // echo $form->field($model, 'makan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
