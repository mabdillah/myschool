<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\search\PelajarKelasSearch */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Yuran Pelajar';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<?= Html::encode($this->title) ?>
			</div>
			<div class="panel-body">
				<?php $form = ActiveForm::begin(); ?>
				<div class="col-sm-4">
				<?php echo $form->field($model, 'pelajar_id')->widget(Select2::classname(),['data' => (ArrayHelper::map(app\models\Pelajar::find()->all(),'id','nama_pelajar')),'pluginOptions'=>['allowClear'=>true],'options' => ['placeholder' => 'Nama Pelajar']])->label('Nama Pelajar') ?>
				</div>

				<div class="clearfix"></div>
				<div class="col-sm-4">
					<div class="form-group">
						<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
					</div>
				<?php ActiveForm::end(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
