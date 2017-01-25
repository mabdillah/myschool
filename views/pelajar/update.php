<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Pelajar */

$this->title = 'Kemaskini Pelajar: ' . $model->nama_pelajar;
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
				'dataProvider'=>$dataProvider,
			]) ?>
			</div>
		</div>
	</div>
</div>

