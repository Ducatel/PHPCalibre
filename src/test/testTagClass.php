<?php
require_once('../class/Tags.php');

$databasePath = 'metadata.db';//'D:/Mes documents/Dropbox/Calibre/metadata.db';

$tags = new Tags();
$tags->loadFromDatabase($databasePath);

?>
<h2>All Tag</h2>
<table>
	<tr>
		<th>Id</th>
		<th>Name</th>
	</tr>
<?php

foreach ($tags as $tag) {
	echo '<tr>';
	echo "<td>".$tag->getId()."</td>";
	echo "<td>".$tag->getName()."</td>";
	echo '</tr>';
}
echo "</table>";

var_dump($tags->find( array("Java") ) );

?>
