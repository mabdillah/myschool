<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Oku */

$this->title = 'Kemaskini Oku';
$this->params['breadcrumbs'][] = ['label' => 'Okus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_oku, 'url' => ['view', 'id' => $model->id_oku]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oku-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
