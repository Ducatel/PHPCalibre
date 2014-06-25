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
	 * Create an publisher from a database row
	 * @param $calibrePublisherRow The database entry which represent an publisher
	 * @return The object which represente the publisher in the database
	 */
	public static function _createFromRow($calibrePublisherRow) {
		$publisher = new self();
		$publisher->id = $calibrePublisherRow['id'];
		$publisher->name = $calibrePublisherRow['name'];
		$arrayKeyword = explode(',' , $calibrePublisherRow['sort']);
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