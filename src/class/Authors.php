<?php
require_once('Collections.php');
require_once('Author.php');
require_once('SPDO.php');


/**
 * This class manage all authors from calibre database
 * @author D.Ducatel
 */
class Authors extends Collections{

	/**
	 * {@inheritDoc}
	 */
	public function loadFromDatabase($calibreDatabasePath){

		$sqlQuery = 'SELECT * FROM authors ORDER BY name';

		$pdo = new SPDO($calibreDatabasePath);
		foreach  ($pdo->query($sqlQuery) as $row)
			$this->listOfObjects[] = Author::_createFromRow($calibreDatabasePath, $row);	

	}

}
?>
