<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Gred */

$this->title = 'Kemaskini Gred';
$this->params['breadcrumbs'][] = ['label' => 'Greds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_gred, 'url' => ['view', 'id' => $model->id_gred]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gred-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
