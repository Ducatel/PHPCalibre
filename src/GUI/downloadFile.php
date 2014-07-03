<?php
/**********************************************************/
/** This page is used make a download link from an ebook **/
/**********************************************************/


define("ERR_INVAL_URL_PARAM", "Invalid URL parameter.");

$arrayExtension = array("pdf","epub");


if(isset($_GET['file']) && !empty($_GET['file'])){

	$file = $_GET["file"];
	$path_parts = pathinfo ($file);
	if(in_array ( strtolower($path_parts['extension']), $arrayExtension)){

		header("Content-Type: application/octet-stream");
		header("Content-Disposition: attachment; filename=" . urlencode($file));   
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		header("Content-Description: File Transfer");            
		header("Content-Length: " . filesize($file));
		flush(); // this doesn't really matter.
		$fp = fopen($file, "r");
		while (!feof($fp))
		{
		    echo fread($fp, 65536);
		    flush(); // this is essential for large downloads
		} 
		fclose($fp); 
	}
	else
		header('Location: ./index.php?errMsg='.ERR_INVAL_URL_PARAM);
}
else
	header('Location: ./index.php?errMsg='.ERR_INVAL_URL_PARAM);

?>