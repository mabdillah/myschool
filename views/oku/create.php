<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Oku */

$this->title = 'Create Oku';
$this->params['breadcrumbs'][] = ['label' => 'Okus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oku-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
