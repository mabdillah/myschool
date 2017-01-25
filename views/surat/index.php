<?php
use yii\helpers\Html;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\Lesson1EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Laporan Mesyuarat';
$this->params['breadcrumbs'][] = $this->title;
$t=isset($t)?$t:"";
?>
<style>body { margin: 0px; } .embed-container { position: relative; padding-bottom: 100%; height: 0; overflow: hidden; max-width: 100%; min-height: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?= Html::encode($this->title) ?>
            </div>
            <div class="panel-body">
				<div class="form">
					<div class="form-group">
					<?php if(Yii::$app->session->getFlash('warning')){ ?>
							<div class="alert alert-warning">
								<a href="#" class="close" data-dismiss="alert">&times;</a>
								<?= Yii::$app->session->getFlash('warning'); ?>
							</div>
					<?php } ?>
					
						<?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]); ?>
						
						<?= $form->field($model, 'bulan')->dropDownList(['01' => 'Januari','02' => 'Februari', '03'=>'Mac', '04'=>'April', '05'=>'Mei', '06'=>'Jun', '07'=>'Julai', '08'=>'Ogos', '09'=>'September', '10'=>'Oktober', '11'=>'November', '12'=>'Disember'],['prompt'=>'Pilih','style'=>'width:180px']) ?>
						<?php $model->tahun=date('Y');?>
						<?= $form->field($model, 'tahun')->textInput(['style'=>'width:100px','maxlength'=>4]) ?>
						
						<label class="control-label col-md-2" for="dynamicmodel-tahun"></label>
						<?= Html::submitButton('Jana Laporan', ['class' => 'btn btn-primary']) ?>
						
					
					<?php ActiveForm::end(); ?>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>

