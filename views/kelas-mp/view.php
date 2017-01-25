<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\KelasMp */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kelas Mps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelas-mp-view">

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
            'sesi.tahun',
            //'id_kelas',
            'nama_kelas:html',
            //'id_guru',
            'guru.nama_guru',
           // 'id_matapelajaran',
            'nama_matapelajaran:html',
        ],
    ]) ?>

</div>
