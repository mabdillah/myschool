<?php 
use yii\helpers\Html;
?>
<div class="yuran-bulanan-view">
    <table border=1 width="100%">
		<tr>
			<td width="10%">Nombor KP</td>
			<td width="1%">:</td>
			<td width="30%"> <?= $model->no_mykid ?></td>
			<td width="10%">Penyata</td>
			<td width="1%">:</td>
			<td width="30%"> <?= $tahun ?> </td>
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
			$kelas = Yii::$app->getDb()->createCommand("SELECT tingkatan,keterangan FROM `pelajar_kelas` inner join kelas on kelas.id=pelajar_kelas.id_kelas inner join ref_kelas on ref_kelas.id=kelas.nama_kelas inner join sesi on sesi.id=kelas.id_sesi WHERE id_pelajar= '". $model->id ."' AND sesi.tahun= '". $tahun ."' ;")->queryOne(); 
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
		$keterangan .= $datum['_van']>0 ? " (Van = RM ".$datum['van'].")" : "";
		$keterangan .= $datum['_tuisyen']>0 ? " (Tuisyen = RM ".$datum['tuisyen'].")" : "";
		$keterangan .= $datum['_makan']>0 ? " (Makan = RM ".$datum['makan'].")" : "";
		$rujukan = $datum['flags_insert'] > 0 ? $datum['catatan'].'<b>'.$bulan[$datum['bulan']].'</b>'.str_replace(') (',', ',$keterangan) : $datum['catatan2'];
		$paparbayar = $bayar > 0 ? number_format($datum['bayaran'],2) : '';
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