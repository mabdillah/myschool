<!-- <link rel="stylesheet" href="/lesen/web/css/bootstrap.css"> -->
<?php
function getPelajar($param,$id){
	$data = \Yii::$app->db->createCommand("SELECT $param FROM `pelajar` WHERE id='".$id."' ")->queryOne();
	return $data[$param];
}
if($pelajar!=''){	
	$data2 = \Yii::$app->db->createCommand("SELECT id FROM `pelajar_kelas` WHERE id_pelajar='".$pelajar."' AND id_kelas IN (select id from kelas where id_sesi IN (select id from sesi where tahun = (SELECT tahun FROM `kelas` inner join sesi on sesi.id=kelas.id_sesi where kelas.id='". $id_kelas ."')));")->queryOne();
	if($data2['id'] > 0){
		echo "<script>alert('Pelajar telah wujud')</script>";
	}else{
		Yii::$app->db->createCommand("INSERT INTO pelajar_kelas (id_pelajar, id_kelas) VALUES ('".$pelajar."', '".$id_kelas."');")->execute();
	}
}
$draf = \Yii::$app->db->createCommand("SELECT * FROM `pelajar_kelas` WHERE id_kelas='$id_kelas' ")->queryAll();	

	$bil=1;
	
		echo '<table border="1" width="100%" style="padding: 6px;border-collapse: collapse;">
	   		<thead>
			<tr bgcolor="#ccc" >
	   			<th width="5%" nowrap="nowrap" style="text-align: center;">Bil.</th>
	   			<th width="10%" nowrap="nowrap" style="text-align: center;">Nama Pelajar</th>
	   			<th style="text-align:center;" width="10%" nowrap="nowrap"></th>
	   		</tr>
			</thead>';
		if(intval($draf)>0){
		foreach($draf as $row) {
			echo '<tr>
				<td valign="top" width="5%" nowrap="nowrap" style="text-align: center;padding: 6px;">'.$bil.'</td>
         		<td valign="top" nowrap="nowrap" style="padding: 6px;">'.getPelajar('nama_pelajar',$row["id_pelajar"]).'</td>
       			<td style="text-align:center;" valign="top" nowrap="nowrap" style="padding: 6px;"><a class="buang" buangid="'.$row["id"].'"><span class="glyphicon glyphicon-trash"></span></a></td>
			</tr>';
			$bil++;
		}
		}else{
			echo '<tr><th colspan=3 style="text-align: center;">Tiada Pilihan dimasukkan</th>';
		}
		echo '</tbody></table><br/>';
?>