<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Bayaran */

$this->title = $model->id_bayaran;
$this->params['breadcrumbs'][] = ['label' => 'Bayarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bayaran-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Kemaskini', ['update', 'id' => $model->id_bayaran], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Padam', ['delete', 'id' => $model->id_bayaran], [
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
            'id_bayaran',
            'id_pelajar',
            'id_kelas',
            'id_bulan',
            'tarikh',
            'duit_perludibayar',
            'duit_terima',
            'baki',
        ],
    ]) ?>

</div>
