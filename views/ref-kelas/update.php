<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefKelas */

$this->title = 'Kemaskini Nama Kelas: ' . $model->keterangan;
$this->params['breadcrumbs'][] = 'Kemaskini';
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<?= Html::encode($this->title) ?>
			</div>
			<div class="panel-body">
			<?= $this->render('_form', [
				'model' => $model,
			]) ?>
			</div>
		</div>
	</div>
</div>
