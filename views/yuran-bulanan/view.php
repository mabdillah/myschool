<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\YuranBulanan */

$this->title = $model->nama_pelajar;
$this->params['breadcrumbs'][] = $this->title;


$kelas = Yii::$app->getDb()->createCommand("SELECT kelas.id,tingkatan,keterangan FROM `pelajar_kelas` inner join kelas on kelas.id=pelajar_kelas.id_kelas inner join ref_kelas on ref_kelas.id=kelas.nama_kelas inner join sesi on sesi.id=kelas.id_sesi WHERE id_pelajar= '". $model->id ."' AND sesi.tahun= '". $tahun ."' ;")->queryOne(); 
?>
<script>
	$(document).ready(function(){
        $('#ontahun').change(function(){
            myform.submit();
        });
    });
	
function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body>";
var footstr = "</body>";
var newstr = document.getElementById(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
</script>

<div class="yuran-bulanan-view">
    <p>
		<?php 
		if($kelas['id']>0){
			echo Html::a('Tetapan', ['pelajar/tetapan','id'=>$model->id],['class'=>'btn btn-primary']);
			echo '&nbsp;'.Html::button('Bayaran', ['value'=>Url::to("create?pelajar_id=".$model->id),'class'=>'btn btn-primary bayaranbuton']);
		}else{
			echo '<span class="label label-warning">Pelajar belum daftar kelas.</span>';
		}
		?>
       <?php //= Html::button('<span class="glyphicon glyphicon-print"></span> Print', ['onclick'=>"printdiv('bil')",'class'=>'btn btn-primary','target'=>'_blank']); ?>
       <?= Html::a('<span class="glyphicon glyphicon-print"></span> Print', ["pelajar/penyata-pdf",'pelajar_id'=>$model->id,'tahun'=>$tahun],['class'=>'btn btn-primary','target'=>'_blank']); ?>
	    
    </p>
<div id="bil">
    <table border=1 width="100%" style="border-radius: 25px; border: 2px solid #2e6da4; padding: 20px; ">
		<tr>
			<td width="10%">Nombor KP</td>
			<td width="1%">:</td>
			<td width="30%"> <?= $model->no_mykid ?></td>
			<td width="10%">Penyata</td>
			<td width="1%">:</td>
			<td width="30%">
				<form method="post" action="" name="myform">
					<?= Html::hiddenInput('_csrf',Yii::$app->request->getCsrfToken()); ?>
					<?= Html::dropDownList('tahun',$tahun,ArrayHelper::map(\app\models\Sesi::find()->orderBy('tahun')->orderBy('tahun DESC')->all(),'tahun', 'tahun' ),['class'=>'','onchange'=>"myform.submit();",'id'=>"ontahun"]) ?>
				</form>
			</td>
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
	<br/>
	<table border=1 width="100%" style="text-align:center; ">
		<tr bgcolor="#A6D9FA">
			<th rowspan=2 style="text-align:center;">Tarikh Urusniaga</th>
			<th rowspan=2 style="text-align:center;">Rujukan</th>
			<th colspan=3 style="text-align:center;">Amaun (RM)</th>
		</tr>
		<tr bgcolor="#A6D9FA">
			<th style="text-align:center;">Debit</th>
			<th style="text-align:center;">Kredit</th>
			<th style="text-align:center;">Baki</th>
		</tr>
		<?php 
		$bulan = array(1=>'Januari',2=>'Febuari',3=>'Mac',4=>'April',5=>'Mei',6=>'Jun',7=>'Julai',8=>'Ogos',9=>'September',10=>'Oktober',11=>'November',12=>'Disember');

		$data = Yii::$app->getDb()->createCommand("SELECT * FROM yuran_bulanan WHERE pelajar_id='". $model->id ."' AND tahun='".$tahun."' ORDER BY id ASC ;")->queryAll(); 
		$baki = 0;$yuran2 = 0;$bayar2 = 0;
		$no=1;
		foreach ($data as $datum) {
		if($no % 2 == 0) $bgcolor = "#EFEEEE"; else $bgcolor = "";
		$keterangan="";
		$yuran = $datum['yuran_bulanan2']=='0.00' ? '' : number_format($datum['yuran_bulanan2'],2);
		$bayar = $datum['bayaran']=='' ? '0' : $datum['bayaran'];
		//Html::a(number_format($datum['bayaran'],2),['surat/resit','id'=>$datum['id']])
		$yuran2 = $yuran2 + $yuran;
		$bayar2 = $bayar2 + $bayar;
		$baki = $yuran2 - $bayar2;
		$dbaki = $baki < 0 ? "(".number_format(abs($baki),2).")" : number_format($baki,2);
		if($datum['_van'] == 1){
			$hala = 'Sehala';
		}elseif($datum['_van'] == 2){
			$hala = '2 hala';
		}else{
			$hala = '';
		}
		if($datum['_tuisyen'] == 1){
			$tuis = 'Tuisyen';
		}elseif($datum['_tuisyen'] == 2){
			$tuis = 'Tuisyen + Makan';
		}else{
			$tuis = '';
		}
		$keterangan .= $datum['_van']>0 ? " (Van $hala = RM ".$datum['van'].")" : "";
		$keterangan .= $datum['_tuisyen']>0 ? " ($tuis = RM ".$datum['tuisyen'].")" : "";
		$keterangan .= $datum['_makan']>0 ? " (Makan = RM ".$datum['makan'].")" : "";
		$rujukan = $datum['flags_insert'] > 0 ? $datum['catatan'].'<b>'.$bulan[$datum['bulan']].'</b>'.str_replace(') (',', ',$keterangan) : $datum['catatan2'];
		$paparbayar = $bayar > 0 ? Html::a(number_format($datum['bayaran'],2),['surat/resit','id'=>$datum['id']]) : '';
		   echo "<tr bgcolor='$bgcolor'>
			<td>".date('d-m-Y',strtotime($datum['date_created']))."</td>
			<td align=left>".$rujukan."</td>
			<td>". $yuran ."</td>
			<td>". $paparbayar ."</td>
			<td>". $dbaki ."</td>
		   </tr>";
		   $no++;
		}  
		?>
		<tfoot>
		<tr bgcolor="#A6D9FA">
			<th></th>
			<th style="text-align:right;">Baki Akhir Dikemaskini</th>
			<th></th>
			<th></th>
			<th style="text-align:center;"><?php echo $baki > 0 ? number_format($baki,2) : $baki; ?></th>
		</tr>
		</tfoot>
	</table>
	</div>
</div>
<?php
yii\bootstrap\Modal::begin([
    'id' => 'bayaran-modal',
    'size' => 'modal-md',
    'header' => '<h4 class="modal-title">Bayaran</h4>',
]); 
echo '<div id="modalContent"></div>';

yii\bootstrap\Modal::end();

$this->registerJs(
    "$('.bayaranbuton').click(function() {
		$('#bayaran-modal').modal('show')
		.find('#modalContent')
		.load($(this).attr('value'));
	});
    "
);
?>