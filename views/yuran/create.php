<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Yuran */

$this->title = 'Create Yuran';
$this->params['breadcrumbs'][] = ['label' => 'Yurans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yuran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
