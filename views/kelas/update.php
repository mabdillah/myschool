<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Kelas */

$this->title = 'Kemaskini Kelas: ' . $model->id;
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
				'dataProvider'=>$dataProvider,
				'dataProvider2'=>$dataProvider2,
			]) ?>
			</div>
		</div>
	</div>
</div>
