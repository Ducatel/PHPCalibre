<?php
require_once('../class/Series.php');

$databasePath = 'metadata.db';//'D:/Mes documents/Dropbox/Calibre/metadata.db';

$series = new Series();
$series->loadFromDatabase($databasePath);

?>
<h2>All series</h2>
<table>
	<tr>
		<th>Id</th>
		<th>Name</th>
		<th>Keywords</th>
	</tr>
<?php

foreach ($series as $serie) {
	echo '<tr>';
	echo "<td>".$serie->getId()."</td>";
	echo "<td>".$serie->getName()."</td>";
	echo "<td>".implode(', ', $serie->getKeywords())."</td>";
	echo '</tr>';
}
echo "</table>";

var_dump($series->find( array("DiverGence ") ) );

?>
