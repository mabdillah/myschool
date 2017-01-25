<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\KelasMp */

$this->title = 'Create Kelas Mp';
$this->params['breadcrumbs'][] = ['label' => 'Kelas Mps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelas-mp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
