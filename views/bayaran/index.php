<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BayaranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bayarans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bayaran-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bayaran', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            'id_bayaran',
            'id_pelajar',
            'id_kelas',
            'id_bulan',
            'bulan.nama_bulan',
            'tarikh',
            'duit_perludibayar',
            'duit_terima',
            'baki',

            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
