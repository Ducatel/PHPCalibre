<?php
require_once('Collections.php');
require_once('Publisher.php');
require_once('SPDO.php');


/**
 * This class manage all Publishers from calibre database
 * @author D.Ducatel
 */
class Publishers extends Collections{
	
	/**
	 * {@inheritDoc}
	 */
	public function loadFromDatabase($calibreDatabasePath){

		$sqlQuery = 'SELECT * FROM publishers';

		$pdo = new SPDO($calibreDatabasePath);
		foreach  ($pdo->query($sqlQuery) as $row)
			$this->listOfObjects[] = Publisher::_createFromRow($row);	

	}

}

?>