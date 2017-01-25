<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Utils;
use app\models\YuranBulanan;

$this->title = 'Tetapan Yuran: '.date('Y');
$this->params['breadcrumbs'][] = $this->title;

$those = new Utils();

$data = Yii::$app->getDb()->createCommand("Select * FROM master_yuran WHERE tahun=year(curdate());")->queryOne(); 

$hvan = YuranBulanan::getYuranvan($model->id,"harga_van");
$hvan2 = YuranBulanan::getYuranvan($model->id,"harga_van2");
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<?= Html::encode($this->title) ?>
			</div>
			<div class="panel-body">
			<?php $form = ActiveForm::begin(); 
			
			echo Html::hiddenInput('_bulanan',$yuran_bulanan,['id'=>'_bulanan']);
			echo Html::hiddenInput('_van',$hvan,['id'=>'_van']);
			echo Html::hiddenInput('_van2',$hvan2,['id'=>'_van2']);
			echo Html::hiddenInput('_makan',$data['makan'],['id'=>'_makan']);
			echo Html::hiddenInput('_tuisyen',$data['tuisyen'],['id'=>'_tuisyen']);
			echo Html::hiddenInput('_mkntuisyen',$data['makan_tuisyen'],['id'=>'_mkntuisyen']);
			?>
			
			<div class="col-sm-12">
			<table border=1 width="100%" class="table table-striped table-bordered table-hover table-condensed">
			<tr>
				<td width="10%">Nombor KP</td>
				<td width="1%">:</td>
				<td width="30%"> <?= $model->no_mykid ?></td>
				<td width="10%">Bil. Adik Beradik di MDI</td>
				<td width="1%">:</td>
				<td width="30%"> <?php 
				echo YuranBulanan::findbiladikberadik($model->no_mykadBapa)."&nbsp;"; 
				echo $statusadikpotong == 1 ? '(Ada Potongan)' : '(Tiada Potongan)'; ?></td>
			</tr>
			<tr>
				<td>Nama Pelajar</td>
				<td>: </td>
				<td> <?= $model->nama_pelajar ?></td>
				<td>Status Yatim</td>
				<td>: </td>
				<td> <?= $model->status_yatim==1 ? 'Yatim' : '-' ?></td>
			</tr>
			<tr>
				<td>Kelas</td>
				<td>:</td>
				<td><?php
				$kelas = Yii::$app->getDb()->createCommand("SELECT tingkatan,keterangan FROM `pelajar_kelas` inner join kelas on kelas.id=pelajar_kelas.id_kelas inner join ref_kelas on ref_kelas.id=kelas.nama_kelas inner join sesi on sesi.id=kelas.id_sesi WHERE id_pelajar= '". $model->id ."' AND sesi.tahun= '". date('Y') ."' ;")->queryOne(); 
				echo $kelas['tingkatan'].' '.$kelas['keterangan'];
				?></td>
				<td>Status OKU</td>
				<td>: </td>
				<td> <?= $model->status_OKU==1 ? 'Oku' : '-' ?></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>: </td>
				<td colspan=4> <?= $model->alamat .', ('. $model->refAlamat2->Nama_Lokaliti .') '. $model->poskod .' '. $model->daerah .' '. $model->negeri ?></td>
			</tr>
		</table>
			</div>
			<div class="clearfix"></div>
			<?php
				echo '<div class="col-sm-12">
				<table class="table table-hover table-bordered table-striped">
				<thead>
				<tr><th rowspan=2>'.Html::checkbox('flags_s',['onClick'=>""]).'</th><th rowspan=2>Bulan</th><th colspan="5" style="text-align:center">Yuran</th></tr>
				<tr style="text-align:center"><th>Bulanan</th><th>Makan</th><th>Van</th><th>Tuisyen</th></tr></thead> <tbody>';
				$datam = Yii::$app->getDb()->createCommand("Select * FROM tetapan_yuranpelajar WHERE id_pelajar='". $model->id ."';")->queryAll(); 
				foreach ($datam as $datams) {
				   //Html::hiddenInput("id[]", $datams['id'])
				   echo Html::hiddenInput('tetapan['.$datams['id'].'][vanhala]',0,['id'=>'vanhala_'.$datams['id']]);
				   echo Html::hiddenInput('tetapan['.$datams['id'].'][mkntuistyen]',0,['id'=>'mkntuistyen_'.$datams['id']]);
				   echo '<tr>';
				   echo '<td>'.Html::checkbox('tetapan['.$datams['id'].'][flags]',$datams['flags'],['id'=>'flags_'.$datams['id'],'onchange'=>"enabledInput(".$datams['id'].")",'class'=>'sall','disabled'=>$datams['flags'] > 0 ? true : false]).'</td>';
				   echo '<td>'.$those->bulan($datams['bulan']).Html::hiddenInput('tetapan['.$datams['id'].'][bulan]',$datams['bulan']).'</td>';
				   echo '<td>'.Html::textInput('tetapan['.$datams['id'].'][bulanan]', $datams['bulanan'],['class'=>'form-control','id'=>'bulanan_'.$datams['id'],'disabled'=>true]).'</td>';
				   echo '<td>'.Html::textInput("tetapan[".$datams['id']."][makan]", $datams['makan'],['class'=>'form-control','id'=>'makan_'.$datams['id'],'disabled'=>true]).' '.Html::checkbox('chmkn[]',$datams['makan'] > 0 ? 1 : 0,['id'=>'chmkn_'.$datams['id'],'onchange'=>"enabledInputchmkn(".$datams['id'].")",'disabled'=>true]).'</td>';
				   echo '<td>'.Html::textInput("tetapan[".$datams['id']."][van]", $datams['van'],['class'=>'form-control', 'id' => 'van_' . $datams['id'],'disabled'=>true]).' '.Html::checkbox('chvan[]',$datams['vanhala'] == 1 ? 1 : 0,['id'=>'chvan_'.$datams['id'],'onchange'=>"enabledInputchvan(".$datams['id'].")",'disabled'=>true]).' Sehala '.Html::checkbox('chvan2[]',$datams['vanhala'] == 2 ? 1 : 0,['id'=>'chvan2_'.$datams['id'],'onchange'=>"enabledInputchvan2(".$datams['id'].")",'disabled'=>true]).' 2 Hala'.'</td>';
				   echo '<td>'.Html::textInput("tetapan[".$datams['id']."][tuisyen]", $datams['tuisyen'],['class'=>'form-control','id' => 'tuisyen_' . $datams['id'],'disabled'=>true]).' '.Html::checkbox('chtui[]',$datams['mkntuistyen'] == 1 ? 1 : 0,['id'=>'chtui_'.$datams['id'],'onchange'=>"enabledInputchtui(".$datams['id'].")",'disabled'=>true]).' Tiada Makan '.Html::checkbox('chtui2[]',$datams['mkntuistyen'] == 2 ? 1 : 0,['id'=>'chtui2_'.$datams['id'],'onchange'=>"enabledInputchtui2(".$datams['id'].")",'disabled'=>true]).' Ada Makan</td>';
				   echo '</tr>';
				}  
				echo '</tbody>
				</table>
				</div>';
			?>
			<div class="clearfix"></div>
			<div class="col-sm-8">
			<div class="form-group">
				<?= Html::submitButton($model->isNewRecord ? 'Simpan' : 'Simpan', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			</div>
			</div>

			<?php ActiveForm::end(); ?>

			</div>
		</div>
	</div>
</div>

<script>
function enabledInput(id){
	//alert(id);
	if (document.getElementById('flags_'+id).checked) {
        document.getElementById('bulanan_'+id).disabled = false;
        document.getElementById('chmkn_'+id).disabled = false;
        document.getElementById('chvan_'+id).disabled = false;
        document.getElementById('chvan2_'+id).disabled = false;
        document.getElementById('chtui_'+id).disabled = false;
        document.getElementById('chtui2_'+id).disabled = false;
    }else{
        document.getElementById('bulanan_'+id).disabled = true;
        document.getElementById('chmkn_'+id).disabled = true;
        document.getElementById('chvan_'+id).disabled = true;
        document.getElementById('chvan2_'+id).disabled = true;
        document.getElementById('chtui_'+id).disabled = true;
        document.getElementById('chtui2_'+id).disabled = true;
        document.getElementById('chmkn_'+id).checked = false;
        document.getElementById('chvan_'+id).checked = false;
        document.getElementById('chvan2_'+id).checked = false;
        document.getElementById('chtui_'+id).checked = false;
        document.getElementById('chtui2_'+id).checked = false;
        document.getElementById('makan_'+id).value = '0.00';
        document.getElementById('van_'+id).value = '0.00';
        document.getElementById('tuisyen_'+id).value = '0.00';
        document.getElementById('makan_'+id).disabled = true;
        document.getElementById('van_'+id).disabled = true;
        document.getElementById('tuisyen_'+id).disabled = true;
    }
}
function enabledInputchmkn(id){
	var mkn = document.getElementById("_makan").value;
	if (document.getElementById('chmkn_'+id).checked) {
        document.getElementById('makan_'+id).disabled = false;
        document.getElementById('makan_'+id).value = mkn;
    }else{
        document.getElementById('makan_'+id).disabled = true;
		document.getElementById('makan_'+id).value = '0.00';
    }
}
function enabledInputchvan(id){
	var van = document.getElementById("_van").value;
	if (document.getElementById('chvan_'+id).checked) {
        document.getElementById('chvan2_'+id).checked = false;
        document.getElementById('van_'+id).disabled = false;
        document.getElementById('van_'+id).value = van;
        document.getElementById('vanhala_'+id).value = 1;
    }else{
        document.getElementById('van_'+id).disabled = true;
        document.getElementById('van_'+id).value = '0.00';
        document.getElementById('vanhala_'+id).value = 0;
    }
}
function enabledInputchvan2(id){
	var van = document.getElementById("_van2").value;
	if (document.getElementById('chvan2_'+id).checked) {
        document.getElementById('chvan_'+id).checked = false;
        document.getElementById('van_'+id).disabled = false;
        document.getElementById('van_'+id).value = van;
        document.getElementById('vanhala_'+id).value = 2;
    }else{
        document.getElementById('van_'+id).disabled = true;
        document.getElementById('van_'+id).value = '0.00';
        document.getElementById('vanhala_'+id).value = 0;
    }
}
function enabledInputchtui(id){
	var tui = document.getElementById("_tuisyen").value;
	if (document.getElementById('chtui_'+id).checked) {
        document.getElementById('chtui2_'+id).checked = false;
        document.getElementById('tuisyen_'+id).disabled = false;
        document.getElementById('tuisyen_'+id).value = tui;
        document.getElementById('mkntuistyen_'+id).value = 1;
    }else{
        document.getElementById('tuisyen_'+id).disabled = true;
        document.getElementById('tuisyen_'+id).value = '0.00';
        document.getElementById('mkntuistyen_'+id).value = 0;
    }
}
function enabledInputchtui2(id){
	var tui = document.getElementById("_mkntuisyen").value;
	if (document.getElementById('chtui2_'+id).checked) {
        document.getElementById('chtui_'+id).checked = false;
        document.getElementById('tuisyen_'+id).disabled = false;
        document.getElementById('tuisyen_'+id).value = tui;
        document.getElementById('mkntuistyen_'+id).value = 2;
    }else{
        document.getElementById('tuisyen_'+id).disabled = true;
        document.getElementById('tuisyen_'+id).value = '0.00';
        document.getElementById('mkntuistyen_'+id).value = 0;
    }
}
</script>