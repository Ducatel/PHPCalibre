<?php
require_once("CalibreDatabaseObject.php");

/**
 * Represent a Calibre Tag
 * @author D.Ducatel
 */
class Tag extends CalibreDatabaseObject{

	/**
	 * The tag's name
	 */
	private $name;

	/**
	 * Default constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->name = null;
	}

	/**
	 * Create an serie from a database row
	 * @param $calibreSerieRow The database entry which represent an serie
	 * @return The object which represente the serie in the database
	 */
	public static function _createFromRow($calibreSerieRow) {
		$tag = new self();
		$tag->id = $calibreSerieRow['id'];
		$tag->name = $calibreSerieRow['name'];
		return $tag;
	}

    /**
     * Gets the The tag's name.
     *
     * @return mixed
     */
    public function getName(){
        return $this->name;
    }

    /**
     * Gets the An array of keywords for find this tag.
     *
     * @return mixed
     */
    public function getKeywords(){
        return array(stringForComparaison($this->name));
    }
}


?>