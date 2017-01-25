<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PelajarKelas */

$this->title = 'Tambah Kelas Pelajar';
$this->params['breadcrumbs'][] = $this->title;
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
				'id_kelas' => $id_kelas,
			]) ?>
			</div>
		</div>
	</div>
</div>
