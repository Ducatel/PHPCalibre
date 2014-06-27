<?php
require_once("CalibreDatabaseObject.php");

/**
 * Represent a Calibre Publisher
 * @author D.Ducatel
 */
class Publisher extends CalibreDatabaseObject{

	/**
	 * The publisher's name
	 */
	private $name;

	/**
	 * An array of keywords for find this publisher
	 */
	private $keywords;

	/**
	 * Default constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->name = null;
		$this->keywords = array();
	}

	/**
	 * {@inheritDoc}
	 */
	public static function  _createFromRow($databasePath, $calibreObjectRow) {
		$publisher = new self();
		$publisher->databasePath = $databasePath;
		$publisher->id = $calibreObjectRow['id'];
		$publisher->name = $calibreObjectRow['name'];
		$arrayKeyword = explode(',' , $calibreObjectRow['sort']);
		$publisher->keywords = array_map("stringForComparaison" , $arrayKeyword);
		return $publisher;
	}

    /**
     * Gets the The publisher's name.
     *
     * @return mixed
     */
    public function getName(){
        return $this->name;
    }

    /**
     * Gets the An array of keywords for find this publisher.
     *
     * @return mixed
     */
    public function getKeywords(){
        return $this->keywords;
    }
}


?>