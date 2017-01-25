<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\KelasMpSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kelas Mps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kelas-mp-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Kelas Mp', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            'sesi.tahun',
           // 'id_kelas',
            'nama_kelas:html',
            //'id_guru',
            'guru.nama_guru',
            //'id_matapelajaran',
            'nama_matapelajaran:html',


            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
