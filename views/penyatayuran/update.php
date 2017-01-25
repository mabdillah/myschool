<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Penyatayuran */

$this->title = 'Kemaskini Penyatayuran: ' . $model->id_penyata;
$this->params['breadcrumbs'][] = ['label' => 'Penyatayurans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_penyata, 'url' => ['view', 'id' => $model->id_penyata]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penyatayuran-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
