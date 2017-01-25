<?php
/**
 * tambah didalam web/index.php require(__DIR__ . '/../helpers/utils.php');
 * how to call this function : 
 use yii\helpers\Utils;
 Utils::link_ireport(); @ $those = new Utils();
 
 */
namespace yii\helpers;
//use Yii;
class Utils
{
	public static function setHttpHeaders($file){               
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        unlink($file);
        exit;
	}
	public static function bulan($bulan){
		if ($bulan=='1' or $bulan=='01'){
			$getmonth='Januari';
		}elseif ($bulan=='2' or $bulan=='02'){
			$getmonth='Februari';
		}elseif ($bulan=='3' or $bulan=='03'){
			$getmonth='Mac';
		}elseif ($bulan=='4' or $bulan=='04'){
			$getmonth='April';
		}elseif ($bulan=='5' or $bulan=='05'){
			$getmonth='Mei';
		}elseif ($bulan=='6' or $bulan=='06'){
			$getmonth='Jun';
		}elseif ($bulan=='7' or $bulan=='07'){
			$getmonth='Julai';
		}elseif ($bulan=='8' or $bulan=='08'){
			$getmonth='Ogos';
		}elseif ($bulan=='9' or $bulan=='09'){
			$getmonth='September';
		}elseif ($bulan=='10' or $bulan=='10'){
			$getmonth='Oktober';
		}elseif ($bulan=='11'){
			$getmonth='November';
		}elseif ($bulan=='12'){
			$getmonth='Disember';
		}else {
			$getmonth="";
		}
		return $getmonth;
	}
	
	public static function tkhhij($tkh){
		if ($tkh=="" or $tkh=="0000-00-00" or $tkh=="0000-00-00 00:00:00"){
			
			$date="";
		}else {
			$date = strtotime("+1 days", strtotime($tkh));
			$tkh = date("Y-m-d", $date);
			$explodetkh = explode("-",$tkh);
			
			$bulan_masihi=$explodetkh[1];
			$hari_masihi=$explodetkh[2]; 
			$tahun_masihi=$explodetkh[0];
			
			if (($tahun_masihi>1582)||(($tahun_masihi==1582)&&($bulan_masihi>10))||(($tahun_masihi==1582)&&($bulan_masihi==10)&&($hari_masihi>14)))
				{
				$zjd=(int)((1461*($tahun_masihi + 4800 + (int)( ($bulan_masihi-14) /12) ))/4) + (int)((367*($bulan_masihi-2-12*((int)(($bulan_masihi-14)/12))))/12)-(int)((3*(int)(( ($tahun_masihi+4900+(int)(($bulan_masihi-14)/12))/100)))/4)+$hari_masihi-32075;
				}
			else
				{
				$zjd = 367*$tahun_masihi-(int)((7*($tahun_masihi+5001+(int)(($bulan_masihi-9)/7)))/4)+(int)((275*$bulan_masihi)/9)+$hari_masihi+1729777;
				}		
			
			$zl=$zjd-1948440+10632;
			$zn=(int)(($zl-1)/10631);
			$zl=$zl-10631*$zn+354;
			$zj=((int)((10985-$zl)/5316))*((int)((50*$zl)/17719))+((int)($zl/5670))*((int)((43*$zl)/15238));
			$zl=$zl-((int)((30-$zj)/15))*((int)((17719*$zj)/50))-((int)($zj/16))*((int)((15238*$zj)/43))+29;
			
			$bulan_hijri=(int)((24*$zl)/709);
			$hari_hijri=$zl-(int)((709*$bulan_hijri)/24);
			$tahun_hijri=30*$zn+$zj-30;
			
			if($bulan_hijri==1){ $bulan_hijri = "Muharam"; }
			if($bulan_hijri==2){ $bulan_hijri = "Safar"; }
			if($bulan_hijri==3){ $bulan_hijri = "Rabiul Awal"; }
			if($bulan_hijri==4){ $bulan_hijri = "Rabiul Akhir";}
			if($bulan_hijri==5){ $bulan_hijri = "Jamadil Awal";}
			if($bulan_hijri==6){ $bulan_hijri = "Jamadil Akhir";}
			if($bulan_hijri==7){ $bulan_hijri = "Rejab";}
			if($bulan_hijri==8){ $bulan_hijri = "Syaban";}
			if($bulan_hijri==9){ $bulan_hijri = "Ramadhan";}
			if($bulan_hijri==10){ $bulan_hijri = "Syawal";}
			if($bulan_hijri==11){ $bulan_hijri = "Zulkaedah";}
			if($bulan_hijri==12){ $bulan_hijri = "Zulhijah";}
			
			$date = $hari_hijri." ".$bulan_hijri.", ".$tahun_hijri;
		}
		return $date;
	}
	
	public static function timeelapsed ($masa)
	{
		$time = strtotime($masa);
		$time = time() - $time;
		$time = ($time<1)? 1 : $time;
		$tokens = array (
			31536000 => 'year',
			2592000 => 'month',
			604800 => 'week',
			86400 => 'day',
			3600 => 'hour',
			60 => 'minute',
			1 => 'second'
		);

		foreach ($tokens as $unit => $text) {
			if ($time < $unit) continue;
			$numberOfUnits = floor($time / $unit);
			return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
		}

	}
	public static function formatBytes($bytes, $precision = 2) { 
		$units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
	} 
	
	public static function convertNumberToWord($number = false)
	{
		$hyphen      = ' '; // -
		$conjunction = ' dan '; // and
		$separator   = ', ';
		$negative    = 'negative ';
		$decimal     = ' titik '; //point
		/*$dictionary  = array(
			0                   => 'zero',
			1                   => 'one',
			2                   => 'two',
			3                   => 'three',
			4                   => 'four',
			5                   => 'five',
			6                   => 'six',
			7                   => 'seven',
			8                   => 'eight',
			9                   => 'nine',
			10                  => 'ten',
			11                  => 'eleven',
			12                  => 'twelve',
			13                  => 'thirteen',
			14                  => 'fourteen',
			15                  => 'fifteen',
			16                  => 'sixteen',
			17                  => 'seventeen',
			18                  => 'eighteen',
			19                  => 'nineteen',
			20                  => 'twenty',
			30                  => 'thirty',
			40                  => 'fourty',
			50                  => 'fifty',
			60                  => 'sixty',
			70                  => 'seventy',
			80                  => 'eighty',
			90                  => 'ninety',
			100                 => 'hundred',
			1000                => 'thousand',
			1000000             => 'million',
			1000000000          => 'billion',
			1000000000000       => 'trillion',
			1000000000000000    => 'quadrillion',
			1000000000000000000 => 'quintillion'
		);*/
		$dictionary  = array(
			0                   => 'zero',
			1                   => 'satu',
			2                   => 'dua',
			3                   => 'tiga',
			4                   => 'empat',
			5                   => 'lima',
			6                   => 'enam',
			7                   => 'tujuh',
			8                   => 'lapan',
			9                   => 'sembilan',
			10                  => 'sepuluh',
			11                  => 'sebelas',
			12                  => 'dua belas',
			13                  => 'tiga belas',
			14                  => 'empat belas',
			15                  => 'lima belas',
			16                  => 'enam belas',
			17                  => 'tujuh belas',
			18                  => 'lapan belas',
			19                  => 'sembilan belas',
			20                  => 'dua puluh',
			30                  => 'tiga puluh',
			40                  => 'empat puluh',
			50                  => 'lima puluh',
			60                  => 'enam puluh',
			70                  => 'tujuh puluh',
			80                  => 'lapan puluh',
			90                  => 'sembilan puluh',
			100                 => 'ratus',
			1000                => 'ribu',
			1000000             => 'juta',
			1000000000          => 'bilion',
			1000000000000       => 'trilion',
			1000000000000000    => 'quadrilion',
			1000000000000000000 => 'quintilion'
		);
		
		if (!is_numeric($number)) {
			return false;
		}
		
		if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
			// overflow
			trigger_error(
				'Hanya terima nombor -' . PHP_INT_MAX . ' dan ' . PHP_INT_MAX,
				E_USER_WARNING
			);
			return false;
		}

		if ($number < 0) {
			return $negative . Utils::convertNumberToWord(abs($number));
		}
		
		$string = $fraction = null;
		
		if (strpos($number, '.') !== false) {
			list($number, $fraction) = explode('.', $number);
		}
		
		switch (true) {
			case $number < 21:
				$string = $dictionary[$number];
				break;
			case $number < 100:
				$tens   = ((int) ($number / 10)) * 10;
				$units  = $number % 10;
				$string = $dictionary[$tens];
				if ($units) {
					$string .= $hyphen . $dictionary[$units];
				}
				break;
			case $number < 1000:
				$hundreds  = $number / 100;
				$remainder = $number % 100;
				$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
				if ($remainder) {
					$string .= $conjunction . Utils::convertNumberToWord($remainder);
				}
				break;
			default:
				$baseUnit = pow(1000, floor(log($number, 1000)));
				$numBaseUnits = (int) ($number / $baseUnit);
				$remainder = $number % $baseUnit;
				$string = Utils::convertNumberToWord($numBaseUnits) . ' ' . $dictionary[$baseUnit];
				if ($remainder) {
					$string .= $remainder < 100 ? $conjunction : $separator;
					$string .= Utils::convertNumberToWord($remainder);
				}
				break;
		}
		
		if (null !== $fraction && is_numeric($fraction)) {
			$string .= $decimal;
			$words = '';
			//$words = array();
			//foreach (str_split((string) $fraction) as $number) {
			//	$words[] = $dictionary[$number];
			//}
			switch (true) {
				case $fraction < 21:
					$words .= $dictionary[$fraction];
					break;
				case $fraction < 100:
					$tens   = ((int) ($fraction / 10)) * 10;
					$units  = $fraction % 10;
					$words = $dictionary[$tens];
					if ($units) {
						$words .= $hyphen . $dictionary[$units];
					}
					break;
			}
			$string .= $words;
		}
		
		return $string;
	}
}

