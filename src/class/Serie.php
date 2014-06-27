<?php
require_once("CalibreDatabaseObject.php");


/**
 * Represent a Calibre Serie
 * @author D.Ducatel
 */
class Serie extends CalibreDatabaseObject{

	/**
	 * The serie's name
	 */
	private $name;

	/**
	 * An array of keywords for find this serie
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
		$serie = new self();
		$serie->databasePath = $databasePath;
		$serie->id = $calibreObjectRow['id'];
		$serie->name = $calibreObjectRow['name'];
		$arrayKeyword = explode(',' , $calibreObjectRow['sort']);
		$serie->keywords = array_map("stringForComparaison" , $arrayKeyword);
		return $serie;
	}

    /**
     * Gets the The serie's name.
     *
     * @return mixed
     */
    public function getName(){
        return $this->name;
    }

    /**
     * Gets the An array of keywords for find this serie.
     *
     * @return mixed
     */
    public function getKeywords(){
        return $this->keywords;
    }
}


?>