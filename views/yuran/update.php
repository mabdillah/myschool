<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Yuran */

$this->title = 'Update Yuran: ' . $model->id_yuran;
$this->params['breadcrumbs'][] = ['label' => 'Yurans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_yuran, 'url' => ['view', 'id' => $model->id_yuran]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="yuran-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
