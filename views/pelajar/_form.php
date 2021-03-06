<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use kartik\tabs\TabsX;
use kartik\select2\Select2;
$this->registerJs('permanentTab();', yii\web\View::POS_END); 

/* @var $this yii\web\View */
/* @var $model app\models\Pelajar */
/* @var $form yii\widgets\ActiveForm */
$t1="";$t2="";
?>

<div class="pelajar-form">

    <?php 
	$form = ActiveForm::begin(); 
	$model->status_OKU = $model->status_OKU > 0 ? $model->status_OKU : 0;
	$model->status_yatim = $model->status_yatim > 0 ? $model->status_yatim : 0;
	$model->id_status = $model->id_status > 0 ? $model->id_status : 1;
	?>
	<?= $form->errorSummary($model); ?>
    <?php 
	$t1 .= '<div class="row"><div class="col-sm-4">';
	$t1 .= $form->field($model, 'nama_pelajar')->textInput(['maxlength' => true]);
	$t1 .= '</div><div class="col-sm-4">';
	$t1 .= $form->field($model, 'no_mykid')->widget(\yii\widgets\MaskedInput::className(), [
		'mask' => '999999-99-9999'
	]); 
	$t1 .= '</div><div class="col-sm-4">';
	$t1 .= $form->field($model, 'no_sijilLahir')->textInput(['maxlength' => true]);
	$t1 .= '</div>';
	$t1 .= '<div class="col-sm-4">';
	$t1 .= $form->field($model, 'alamat')->textInput(['maxlength' => true]);
	$t1 .= '</div><div class="col-sm-4">';
	$t1 .= $form->field($model, 'alamat2')->widget(Select2::classname(),['data' => ArrayHelper::map(\app\models\RefLokaliti::find()->orderBy('Nama_Lokaliti')->all(),'REC_ID', 'Nama_Lokaliti' ),'options' => ['placeholder' => 'Sila Pilih']]);
	$t1 .= '</div><div class="clearfix"></div><div class="col-sm-4">';
	$t1 .= $form->field($model, 'poskod')->widget(Select2::classname(),['data' => ArrayHelper::map(\app\models\RefPoskod::find()->orderBy('postcode')->where('`postcode` between 20000 and 24300')->all(),'postcode', 'postcode' ),'options' => ['placeholder' => 'Carian Poskod','onchange'=>'$.get( "'.yii\helpers\Url::toRoute('/pelajar/poskod').'", { id: $(this).val() } ) .done(function( data ) { $( "#'.Html::getInputId($model, 'negeri').'" ).val( data.state_name ); $( "#'.Html::getInputId($model, 'daerah').'" ).val( data.post_office ); } );']]);
	$t1 .= '</div><div class="col-sm-4">';
	$t1 .= $form->field($model, 'daerah')->textInput(['readonly' => true]);
	$t1 .= '</div><div class="col-sm-4">';
	$t1 .= $form->field($model, 'negeri')->textInput(['readonly' => true]);
	$t1 .= '</div><div class="clearfix"></div><div class="col-sm-4">';
	$t1 .= $form->field($model, 'jantina')->dropDownList(['L' => 'Lelaki','P'=>'Perempuan']);
	$t1 .= '</div><div class="col-sm-4">';
	$t1 .= $form->field($model, 'kaum')->widget(Select2::classname(),['data' => (ArrayHelper::map(app\models\RefKaum::find()->orderBy('id')->all(),'id','keterangan')),'pluginOptions'=>['allowClear'=>true],'options' => ['placeholder' => 'Sila Pilih',]]);
	$t1 .= '</div><div class="col-sm-4">';
	$t1 .= $form->field($model, 'warganegara')->widget(Select2::classname(),['data' => (ArrayHelper::map(app\models\RefWarganegara::find()->orderBy('id')->all(),'id','keterangan')),'pluginOptions'=>['allowClear'=>true],'options' => ['placeholder' => 'Sila Pilih',]]);
	$t1 .= '</div><div class="clearfix"></div><div class="col-sm-4">';
	//$t1 .= $form->field($model, 'status_yatim')->radioList(ArrayHelper::map(\app\models\Yatim::find()->all(),'id_yatim','statusyatim'));
	$t1 .= $form->field($model, 'status_yatim')->checkbox();
	$t1 .= '</div><div class="col-sm-4">';
	$t1 .= $form->field($model, 'status_OKU')->checkbox();
	$t1 .= '</div><div class="col-sm-4">';
	$t1 .= $form->field($model, 'id_status')->radioList(ArrayHelper::map(\app\models\Status::find()->all(),'id_status','keterangan'));
	$t1 .= '</div><div class="col-sm-4">';
	$t1 .= $form->field($model, 'catatan')->textarea(['rows' => 3]) ;
	$t1 .= '</div>';
	$t1 .= '</div>';
	
	$t2 .= '<div class="row">';
	$t2 .= '<div class="col-sm-4">';
	$t2 .= $form->field($model, 'nama_bapa')->textInput(['maxlength' => true]);
	$t2 .= '</div><div class="col-sm-4">';
	$t2 .= $form->field($model, 'no_mykadBapa')->textInput(['maxlength' => true]);
	$t2 .= '</div><div class="clearfix"></div>
	<div class="col-sm-4">';
	$t2 .= $form->field($model, 'pekerjaan_bapa')->textInput(['maxlength' => true]);
	$t2 .= '</div><div class="col-sm-4">';
	$t2 .= $form->field($model, 'no_telBapa')->textInput(['maxlength' => true]);
	$t2 .= '</div><div class="clearfix"></div>
	<div class="col-sm-4">';
	$t2 .= $form->field($model, 'nama_ibu')->textInput(['maxlength' => true]);
	$t2 .= '</div><div class="col-sm-4">';
	$t2 .= $form->field($model, 'no_mykadIbu')->textInput(['maxlength' => true]);
	$t2 .= '</div><div class="clearfix"></div>
	<div class="col-sm-4">';
	$t2 .= $form->field($model, 'pekerjaan_ibu')->textInput(['maxlength' => true]);
	$t2 .= '</div><div class="col-sm-4">';
	$t2 .= $form->field($model, 'no_telIbu')->textInput(['maxlength' => true]);
	$t2 .= '</div>';
	$t2 .= '</div>';
	
	$t3 = '<div class="row">';
	
	$t3 .= '<div class="col-sm-4">';
	$t3 .= $form->field($model, 'badan_beruniform')->widget(Select2::classname(),['data' => (ArrayHelper::map(app\models\RefBadanberuniform::find()->all(),'id','keterangan')),'pluginOptions'=>['allowClear'=>true],'options' => ['placeholder' => 'Sila Pilih',]]);
	$t3 .= '</div><div class="col-sm-4">';
	$t3 .= $form->field($model, 'persatuan')->widget(Select2::classname(),['data' => (ArrayHelper::map(app\models\RefPersatuan::find()->all(),'id','keterangan')),'pluginOptions'=>['allowClear'=>true],'options' => ['placeholder' => 'Sila Pilih',]]);
	$t3 .= '</div><div class="col-sm-4">';
	$t3 .= $form->field($model, 'rumah_sukan')->widget(Select2::classname(),['data' => (ArrayHelper::map(app\models\RefRumahsukan::find()->all(),'id','keterangan')),'pluginOptions'=>['allowClear'=>true],'options' => ['placeholder' => 'Sila Pilih',]]);
	
	$t3 .= '</div>';
	$t3 .= '</div>';

	$t4 = '<div class="row">';
	if(!$model->isNewRecord){
		
		$datakelaslama = Yii::$app->getDb()->createCommand("SELECT kelas.id FROM `pelajar_kelas` inner join kelas on kelas.id=pelajar_kelas.id_kelas where kelas.id_sesi = (select id from sesi where tahun=YEAR(curdate())) and pelajar_kelas.id_pelajar='".$model->id ."'")->queryOne();
		if($datakelaslama['id']>0){
			$model->id_pelajar_kelas = $datakelaslama['id'];
		}
	}
	if(\Yii::$app->user->can('Guru')){
		$datakelas = Yii::$app->getDb()->createCommand("SELECT kelas.id,concat(tingkatan,' - ',keterangan,' (',tahun,')') kelasinfo FROM `kelas` inner join sesi on kelas.id_sesi = sesi.id inner join ref_kelas on nama_kelas=ref_kelas.id WHERE id_guru IN (select id from guru where id_guru = '". Yii::$app->user->id ."') AND tahun >= YEAR(CURDATE()) ORDER by tahun,tingkatan ASC")->queryAll();
	}else{
		$datakelas = Yii::$app->getDb()->createCommand("SELECT kelas.id,concat(tingkatan,' ',keterangan,' - ',tahun) kelasinfo FROM `kelas` inner join sesi on kelas.id_sesi = sesi.id inner join ref_kelas on nama_kelas=ref_kelas.id WHERE tahun >= YEAR(CURDATE()) order by tahun,tingkatan ASC")->queryAll();
	}
	$t4 .= '<div class="col-sm-8">';
	$t4 .= $form->field($model, 'id_pelajar_kelas')->widget(Select2::classname(),
		[
			'data' => ArrayHelper::map($datakelas,'id', 'kelasinfo'),
			'pluginOptions'=>[
				'allowClear'=>true
			],
			'options' => [
				'placeholder' => 'Carian Kelas'
			],
			'disabled'=>$id_kelas > 0 ? true : false
		])->label('Kelas Baru');
	$t4 .= '</div>';
	
	$t4 .= '</div>';
	
	
	echo TabsX::widget([
            'items' => [
				['label' => '<i class="glyphicon glyphicon-user"></i> Peribadi','content' => $t1,'active' =>true],
				['label' => '<i class="glyphicon glyphicon-user"></i> Ibu Bapa','content' => $t2],
				['label' => '<i class="glyphicon glyphicon-user"></i> Kokurikulum','content' => $t3],
				['label' => '<i class="glyphicon glyphicon-user"></i> Kelas','content' => $t4],
			], 
            'position' => TabsX::POS_ABOVE,
            'align' => TabsX::ALIGN_LEFT,
			'bordered'=>true,
			'encodeLabels'=>false,
        ]);
	?>
	<br/>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Simpan & Tambah Baru' : 'Simpan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','value'=>1,'name'=>'btn']) ?>
        <?= Html::submitButton($model->isNewRecord ? 'Simpan dan Lihat' : 'Simpan dan Lihat', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','value'=>2,'name'=>'btn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
