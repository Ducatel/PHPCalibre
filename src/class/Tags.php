<?php
require_once('Collections.php');
require_once('Tag.php');
require_once('SPDO.php');


/**
 * This class manage all Tags from calibre database
 * @author D.Ducatel
 */
class Tags extends Collections{
	
	/**
	 * {@inheritDoc}
	 */
	public function loadFromDatabase($calibreDatabasePath){

		$sqlQuery = 'SELECT * FROM tags';

		$pdo = new SPDO($calibreDatabasePath);
		foreach  ($pdo->query($sqlQuery) as $row)
			$this->listOfObjects[] = Tag::_createFromRow($row);	

	}

}

?>