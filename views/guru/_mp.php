<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Guru */

$this->title = 'Mata Pelajaran: ' . $model->nama_guru;
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
    <?= $form->field($model, 'nama_guru')->textInput(['readonly' => true]) ?>
	</div>
	<div class="col-sm-4">
	<?php echo $form->field($model2, 'darjah')->dropDownList([1=>1,2=>2,3=>3,4=>4,5=>5,6=>6],['prompt'=>'Semua']);?>
	</div>
	<div class="col-sm-4">
	<?php echo $form->field($model2, 'sesi')->dropDownList(ArrayHelper::map(\app\models\Sesi::find()->all(),'id','tahun'),['prompt'=>'Sila Pilih']);?>
	</div>
	
	<div class="clearfix"></div>	
	<div class="col-sm-4">	
		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-success','name'=>'btn','value'=>'1']) ?>
		</div>
	</div>
	<?php 
	if($model2->sesi){
		//$rows = \app\models\Kelas::find()->select(['nama_kelas','id'])->where(['id_sesi' => $model2->sesi])->orderBy('nama_kelas')->all();
		$condition = "";
		if($model2->darjah > 0){
			$condition = " AND tingkatan='". $model2->darjah ."'";
		}
		$rows = Yii::$app->getDb()->createCommand("SELECT kelas.id,ref_kelas.keterangan AS keterangan,tingkatan FROM kelas INNER JOIN ref_kelas ON ref_kelas.id=kelas.nama_kelas WHERE id_sesi='". $model2->sesi ."' $condition ORDER BY tingkatan, keterangan ASC;")->queryAll();
		if(count($rows)>0){
			echo "<table class='table table-hover' >
			<thead><tr><th>Darjah / Kelas</th><th>Mata Pelajaran</th></tr></thead>";
			$bil = 0;
			//$aa[2] = explode(',','3,6,7');
			//echo '<pre>';print_r($aa);echo '</pre>';
			foreach($rows as $row){
				$kelas_mp = Yii::$app->getDb()->createCommand("SELECT id_matapelajaran FROM kelas_mp WHERE id_guru='". $model->id ."' AND id_kelas='". $row['id'] ."' ")->queryOne(); 
				$matapelajaran[$bil] = explode(',',$kelas_mp['id_matapelajaran']);
				//echo $kelas_mp['id_matapelajaran'].'<pre>';print_r($matapelajaran[$bil]);echo '</pre>';
				echo $form->field($model2, "kelas[]")->hiddenInput(['value' => $row['id'] ])->label(false);
                echo "<tr>";
                echo "<td>". $row['tingkatan'] .' '. $row['keterangan'] ."</td>";
                //echo "<td>". $form->field($model2, "matapelajaran[$bil][]")->checkboxlist(ArrayHelper::map(\app\models\Matapelajaran::find()->all(),'id','nama_matapelajaran'))->label(false) ."</td>";
                echo "<td>". Html::checkboxList("matapelajaran[$bil][]",$matapelajaran[$bil],ArrayHelper::map(\app\models\Matapelajaran::find()->all(),'id','nama_matapelajaran')) ."</td>";
                echo "</tr>";
				$bil++;
            }
			echo "</table>";
			echo '<div class="form-group">';
			echo Html::submitButton('Simpan',['class' => 'btn btn-primary','name'=>'btn','value'=>'2']);
			echo '</div>';
        }else{
            echo "<div class='clearfix'></div><p>Tiada data!</p>";
        }
		
	}
	 
	?>
	
	

    <?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>
</div>
