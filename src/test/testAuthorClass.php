<?php
require_once('../class/Authors.php');

$databasePath = 'metadata.db';//'D:/Mes documents/Dropbox/Calibre/metadata.db';

$authors = new Authors();
$authors->loadFromDatabase($databasePath);

?>
<h2>All Authors</h2>
<table>
	<tr>
		<th>Id</th>
		<th>Name</th>
		<th>Keywords</th>
		<th>link</th>
	</tr>
<?php

foreach ($authors as $author) {
	echo '<tr>';
	echo "<td>".$author->getId()."</td>";
	echo "<td>".$author->getName()."</td>";
	echo "<td>".implode(', ', $author->getKeywords())."</td>";
	echo "<td>".$author->getLink()."</td>";
	echo '</tr>';
}
echo "</table>";

var_dump($authors->find( array("Veronica ") ) );

?>
