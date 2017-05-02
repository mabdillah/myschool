<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\SumbanganSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sumbangan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_jenissumbangan') ?>

    <?= $form->field($model, 'nama') ?>

    <?= $form->field($model, 'jumlah') ?>

    <?= $form->field($model, 'tarikh_sumbangan') ?>

    <?php // echo $form->field($model, 'tarikh_dicipta') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
