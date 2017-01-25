<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\YuranBulanan */

$this->title = 'Update Yuran Bulanan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Yuran Bulanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="yuran-bulanan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
