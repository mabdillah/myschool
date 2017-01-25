<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PelajarKelas */

$this->title = 'Kemaskini Pelajar Kelas';
$this->params['breadcrumbs'][] = ['label' => 'Pelajar Kelas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pelajar-kelas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('pk', [
        'model' => $model,
    ]) ?>

</div>
