<?php
require_once('../class/SPDO.php');
require_once('../class/Author.php');

$databasePath = 'D:/Mes documents/Dropbox/Calibre/metadata.db';

$sqlQuery = 'SELECT * FROM authors';

$pdo = new SPDO($databasePath);
foreach  ($pdo->query($sqlQuery) as $row) {
	print $row['name'] . "\t";
	print  $row['id'] . "\t";
}


?>