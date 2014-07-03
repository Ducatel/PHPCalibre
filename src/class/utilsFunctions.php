<?php

/**
 * This method is use for transform a string in a comparable string
 * @param  $str The string you want to convert
 * @return The converted string
 */
function stringForComparaison($str){
	return strtolower(trim($str));
}


/**
 * Create a DateTime object from a SQLite time
 * @param $sqliteTime An SQlite timestamp value
 * @return A DateTime object which represent the SQlite timestamp or a default DateTime object if an error occured
 */
function createDateFromSQliteTimestamp($sqliteTime){
	$date = DateTime::createFromFormat ( 'Y-m-d H:i:s.uP' , $sqliteTime );
	return($date === false) ? new DateTime() : $date;
}

/**
 * Generate an HTML code which use for display an alert box
 * @param  [type] $msg        The message you want to display
 * @param  [type] $isErrorMsg if True create and error box else create an succeed box
 * @return The HTML of the alert box
 */
function generateAlertBox($msg, $isErrorMsg){
	$classCss = ($isErrorMsg) ? "alert-danger" : "alert-success";
	$title = ($isErrorMsg) ? "Error" : "Success";
	$alertBox = '<div class="alert '.$classCss.' alert-dismissible" role="alert">';
	$alertBox .= '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
	$alertBox .= '<b>'.$title.':</b> '.$msg.'</div></aside></div>';
	return $alertBox;
}

/**
 * Generate an html rating view on 5 star
 * @param $rating The rating you want to display (-1 < rating < 11)
 * @return The HTML code for this rating
 */
function generateRatingView($rating){

	$numberFullStar = floor ($rating / 2);
	$haveHalStar = ($rating % 2 != 0);
	$numberEmptyStar = 5 - $numberFullStar - (($haveHalStar) ? 1 : 0);

	$html ="";

	for($i = 0 ; $i < $numberFullStar ; $i++)
		$html .= '<span class="fa fa-star">';
	if ($haveHalStar)
		$html .= '<span class="fa fa-star-half-o">';
	for($i = 0 ; $i < $numberEmptyStar ; $i++)
		$html .= '<span class="fa fa-star-o">';
	return $html;
}
?>