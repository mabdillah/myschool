<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Markah */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Markahs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="markah-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Kemaskini', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Padam', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_pelajar',
            'id_exam',
            'markah1',
            'markah2',
            'jumlah',
            'gred',
        ],
    ]) ?>

</div>
