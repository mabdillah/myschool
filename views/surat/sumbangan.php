<?php

// Include classes
include_once('mytools/opentbs/demo/tbs_class.php'); // Load the TinyButStrong template engine
include_once('mytools/opentbs/tbs_plugin_opentbs.php'); // Load the OpenTBS plugin

// prevent from a PHP configuration problem when using mktime() and date()
if (version_compare(PHP_VERSION,'5.1.0')>=0) {
	if (ini_get('date.timezone')=='') {
		date_default_timezone_set('UTC');
	}
}

// Initialize the TBS instance
$TBS = new clsTinyButStrong; // new instance of TBS
$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); // load the OpenTBS plugin

//$link = mysql_connect("localhost", "root", "")
//or die("Could not connect : " . mysql_error());

//mysql_select_db("lesen") or die("Could not select database");

// ------------------------------
// Prepare some data for the demo
// ------------------------------

// Retrieve the user name to display

$sql="SELECT keterangan,catatan,nama, date_format(tarikh_sumbangan,'%d-%m-%Y') tarikh_sumbangan,sumbangan.id as ids,format(jumlah,2) jumlah FROM `sumbangan` left join ref_jenissumbangan on sumbangan.id_jenissumbangan = ref_jenissumbangan.id WHERE sumbangan.id='".$id."'";
$getrec = \Yii::$app->db->createCommand($sql)->queryAll();

/*$data = array();
 foreach ($getrec as $rowp) {
	$data[] =array(
		"ids"=>$rowp['ids'], 
		"keterangan"=>$rowp['keterangan'], 
		"jumlah"=>$rowp['jumlah'], 
		"tarikh_sumbangan"=>$rowp['tarikh_sumbangan'],
		"catatan"=>$rowp['catatan'],
		"jumlah"=>number_format($rowp['jumlah'],2),
	);
 }
print_r($getrec);
print_r($data);
 die();
*/
// -----------------
// Load the template
// -----------------

$template = Yii::getAlias('@app').'/views/surat/sumbangan.docx';
$namafail = 'sumbangan.docx';

$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).

// ----------------------
// Debug mode of the demo
// ----------------------
if (isset($_POST['debug']) && ($_POST['debug']=='current')) $TBS->Plugin(OPENTBS_DEBUG_XML_CURRENT, true); // Display the intented XML of the current sub-file, and exit.
if (isset($_POST['debug']) && ($_POST['debug']=='info'))    $TBS->Plugin(OPENTBS_DEBUG_INFO, true); // Display information about the document, and exit.
if (isset($_POST['debug']) && ($_POST['debug']=='show'))    $TBS->Plugin(OPENTBS_DEBUG_XML_SHOW); // Tells TBS to display information when the document is merged. No exit.

// --------------------------------------------
// Merging and other operations on the template
// --------------------------------------------

$TBS->MergeBlock('a', $getrec);

// Delete comments
$TBS->PlugIn(OPENTBS_DELETE_COMMENTS);

// -----------------
// Output the result
// -----------------

// Define the name of the output file
$save_as = (isset($_POST['save_as']) && (trim($_POST['save_as'])!=='') && ($_SERVER['SERVER_NAME']=='localhost')) ? trim($_POST['save_as']) : '';
$output_file_name = str_replace('.', '_'.$getrec[0]['nama'].$save_as.'.', $namafail);
if ($save_as==='') {
	// Output the result as a downloadable file (only streaming, no data saved in the server)
	$TBS->Show(OPENTBS_DOWNLOAD, $output_file_name); // Also merges all [onshow] automatic fields.
	// Be sure that no more output is done, otherwise the download file is corrupted with extra data.
	exit();
} else {
	// Output the result as a file on the server.
	$TBS->Show(OPENTBS_FILE, $output_file_name); // Also merges all [onshow] automatic fields.
	// The script can continue.
	exit("File [$output_file_name] has been created.");
}
