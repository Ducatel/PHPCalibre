<?php
require_once('../class/Publishers.php');

$databasePath = 'metadata.db';//'D:/Mes documents/Dropbox/Calibre/metadata.db';

$publishers = new Publishers();
$publishers->loadFromDatabase($databasePath);

?>
<h2>All publishers</h2>
<table>
	<tr>
		<th>Id</th>
		<th>Name</th>
		<th>Keywords</th>
	</tr>
<?php

foreach ($publishers as $publisher) {
	echo '<tr>';
	echo "<td>".$publisher->getId()."</td>";
	echo "<td>".$publisher->getName()."</td>";
	echo "<td>".implode(', ', $publisher->getKeywords())."</td>";
	echo '</tr>';
}
echo "</table>";

var_dump($publishers->find( array("Veronica ") ) );

?>
