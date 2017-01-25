<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Markah */

$this->title = 'Papar Markah';
$this->params['breadcrumbs'][] = ['label' => 'Markahs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="markah-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_papar', [
        'model' => $model,
    ]) ?>

</div>
