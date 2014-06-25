<?php
require_once("utilsFunctions.php");

/**
 * This is a superclass of all calibre object in database
 * @author D.Ducatel
 */
class CalibreDatabaseObject{

	/**
	 * The unique id of this object
	 */
	protected $id;

	/**
	 * Default constructor
	 */
	public function __construct() {
		$this->id = -1;
	}

	/**
	 * Create an object from a database row
	 * @param $calibreAuthorRow The database entry which represent an calibre object
	 * @return The object which represente the calibre object in the database
	 */
	public static function _createFromRow($calibreAuthorRow){
		$calibreDatabaseObject = new self();
		$calibreDatabaseObject->id = $calibreAuthorRow['id'];
		return $calibreDatabaseObject;
	}
	
	/**
	 * Get the identifier of this author
	 * @return The identifier of this author 
	 */
	public function getId(){
		return $this->id;
	}
	
}

?>