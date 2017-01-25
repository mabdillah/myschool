<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Penyatayuran */

$this->title = $model->id_penyata;
$this->params['breadcrumbs'][] = ['label' => 'Penyatayurans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penyatayuran-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_penyata], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_penyata], [
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
            'id_penyata',
            'darjah',
            'nama_kelas:html',
            'sesi.tahun',
            'bulan.nama_bulan',
            'yuran_belajar',
            'yuran_makan',
            'yuran_pengangkutan',
            'yuran_tuisyen',
            'yuran_tuisyenmakan',
            'discount',
            'jumlah',
        ],
    ]) ?>

</div>
