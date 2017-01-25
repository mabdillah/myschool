<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\YuranBulanan */

$this->title = 'Bayaran Yuran';
$this->params['breadcrumbs'][] = ['label' => 'Yuran Bulanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yuran-bulanan-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
