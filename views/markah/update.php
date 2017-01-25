<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Markah */

$this->title = 'Kemaskini Markah: ';
$this->params['breadcrumbs'][] = ['label' => 'Markah', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="markah-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
