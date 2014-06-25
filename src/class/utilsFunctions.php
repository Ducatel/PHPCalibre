<?php

/**
 * This method is use for transform a string in a comparable string
 * @param  $str The string you want to convert
 * @return The converted string
 */
function stringForComparaison($str){
	return strtolower(trim($str));
}


?>