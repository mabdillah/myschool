<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bayaran */

$this->title = 'Kemaskini Bayaran: ' . $model->id_bayaran;
$this->params['breadcrumbs'][] = ['label' => 'Bayarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_bayaran, 'url' => ['view', 'id' => $model->id_bayaran]];
$this->params['breadcrumbs'][] = 'Kemaskini';
?>
<div class="bayaran-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
