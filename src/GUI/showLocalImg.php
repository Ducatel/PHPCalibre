<?php
/*******************************************************/
/** This page is used for reading a cover from local **/
/******************************************************/


if(isset($_GET['imgPath']) && !empty($_GET['imgPath'])){

	$location = $_GET['imgPath'];

	$path_parts = pathinfo ($location);
	if($path_parts['basename'] == "cover.jpg" ){
		header("Content-type: image/jpeg");
		echo file_get_contents($location);
	}

}
?>