<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PenyatayuranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penyatayurans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penyatayuran-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Penyatayuran', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
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

            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
