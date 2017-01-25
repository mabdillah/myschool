<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BayaranSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bayaran-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_bayaran') ?>

    <?= $form->field($model, 'id_pelajar') ?>

    <?= $form->field($model, 'id_kelas') ?>

    <?= $form->field($model, 'id_bulan') ?>

    <?= $form->field($model, 'tarikh') ?>

    <?php // echo $form->field($model, 'duit_perludibayar') ?>

    <?php // echo $form->field($model, 'duit_terima') ?>

    <?php // echo $form->field($model, 'baki') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
