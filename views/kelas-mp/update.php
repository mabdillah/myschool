<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KelasMp */

$this->title = 'Kemaskini Kelas';
$this->params['breadcrumbs'][] = ['label' => 'Kelas Mps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelas-mp-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
