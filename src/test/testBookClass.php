<?php
require_once('../class/Books.php');

$databasePath = 'metadata.db';//'D:/Mes documents/Dropbox/Calibre/metadata.db';

$books = new Books();
$books->loadFromDatabase($databasePath);

?>
<h2>All Books</h2>
<table>
	<tr>
		<th>Id</th>
		<th>Name</th>
		<th>Keywords</th>
		<th>creation Date</th>
		<th>publication Date</th>
		<th>last Modified</th>
		<th>isbn</th>
		<th>lccn</th>
		<th>path</th>
		<th>hasCover</th>
		<th>comment</th>
		<th>lang</th>
	</tr>
<?php

foreach ($books as $book) {
	echo '<tr>';
	echo "<td>".$book->getId()."</td>";
	echo "<td>".$book->getName()."</td>";
	echo "<td>".implode(', ', $book->getKeywords())."</td>";
	echo "<td>".$book->getCreationDate()->format('Y-m-d H:i:s')."</td>";
	echo "<td>".$book->getPublicationDate()->format('Y-m-d H:i:s')."</td>";
	echo "<td>".$book->getLastModified()->format('Y-m-d H:i:s')."</td>";
	echo "<td>".$book->getIsbn()."</td>";
	echo "<td>".$book->getLccn()."</td>";
	echo "<td>".$book->getPath()."</td>";
	echo "<td>".$book->hasCover()."</td>";
	echo "<td>".$book->getComment()."</td>";
	echo "<td>".$book->getLanguage()."</td>";
	echo '</tr>';
}
echo "</table>";

var_dump($books->find( array("reseaux ") ) );

var_dump($books->findByLanguage( "eng" ) );

?>
