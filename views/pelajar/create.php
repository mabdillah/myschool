<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pelajar */

$this->title = 'Tambah Pelajar';
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
			]) ?>
			</div>
		</div>
	</div>
</div>
