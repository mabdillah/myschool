<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\YuranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Yurans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="yuran-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Yuran', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

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

            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
