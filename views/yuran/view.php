<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Yuran */

$this->title = $model->id_yuran;
$this->params['breadcrumbs'][] = ['label' => 'Yurans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yuran-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_yuran], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_yuran], [
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
            'id_yuran',
            'id_pelajar',
            'id_kelas',
            'id_bulan',
            'bulan.nama_bulan',
            'yuran_pelajaran',
            //'baki_yuran_belajar',
            'yuran_makan',
            //'baki_yuran_makan',
            'yuran_pengangkutan',
            //'baki_yuran_pengangkutan',
            'yuran_tuisyen',
            //'baki_yuran_tuisyen',
            'yuran_tuisyen_makan',
            //'baki_yuran_tuisyen_makan',
        ],
    ]) ?>

</div>
