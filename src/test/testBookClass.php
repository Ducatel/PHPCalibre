<?php
require_once('../class/Books.php');

$databasePath = 'C:/wamp/www/Calibre/metadata.db';//'D:/Mes documents/Dropbox/Calibre/metadata.db';

$books = new Books();
$books->loadFromDatabase($databasePath);

foreach ($books as $book) {
	var_dump($book);
	echo '<hr/><br/>';

}


var_dump($books->find( array("reseaux ") ) );

var_dump($books->findByLanguage( "eng" ) );

?>
