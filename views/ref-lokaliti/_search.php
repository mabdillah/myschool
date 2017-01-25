<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RefLokalitiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ref-lokaliti-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'REC_ID') ?>

    <?= $form->field($model, 'Kod_Negeri') ?>

    <?= $form->field($model, 'Kod_Parlimen') ?>

    <?= $form->field($model, 'Kod_DUN') ?>

    <?= $form->field($model, 'Kod_Daerah') ?>

    <?php // echo $form->field($model, 'Kod_Lokaliti') ?>

    <?php // echo $form->field($model, 'Nama_Lokaliti') ?>

    <?php // echo $form->field($model, 'harga_van') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
