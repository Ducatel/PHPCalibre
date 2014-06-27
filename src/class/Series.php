<?php
require_once('Collections.php');
require_once('Serie.php');
require_once('SPDO.php');


/**
 * This class manage all Series from calibre database
 * @author D.Ducatel
 */
class Series extends Collections{

	/**
	 * {@inheritDoc}
	 */
	public function loadFromDatabase($calibreDatabasePath){

		$sqlQuery = 'SELECT * FROM series';

		$pdo = new SPDO($calibreDatabasePath);
		foreach  ($pdo->query($sqlQuery) as $row)
			$this->listOfObjects[] = Serie::_createFromRow($calibreDatabasePath, $row);	

	}

}

?>