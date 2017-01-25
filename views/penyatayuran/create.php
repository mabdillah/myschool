<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Penyatayuran */

$this->title = 'Create Penyatayuran';
$this->params['breadcrumbs'][] = ['label' => 'Penyatayurans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penyatayuran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
