<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Bayaran */

$this->title = 'Create Bayaran';
$this->params['breadcrumbs'][] = ['label' => 'Bayarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bayaran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
