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
	 * Path to the database where this object is located
	 */
	protected $databasePath;

	/**
	 * Default constructor
	 */
	public function __construct() {
		$this->id = -1;
		$this->databasePath = "";
	}

	/**
	 * Create an object from a database row
	 * @param $databasePath Path to the database where this object is located
	 * @param $calibreObjectRow The database entry which represent an calibre object
	 * @return The object which represente the calibre object in the database
	 */
	public static function _createFromRow($databasePath, $calibreObjectRow){
		$calibreDatabaseObject = new self();
		$calibreDatabaseObject->databasePath = $databasePath;
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