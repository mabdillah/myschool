<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Yatim */

$this->title = 'Create Yatim';
$this->params['breadcrumbs'][] = ['label' => 'Yatims', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yatim-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
