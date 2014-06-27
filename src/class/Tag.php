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
	 * {@inheritDoc}
	 */
	public static function  _createFromRow($databasePath, $calibreObjectRow) {
		$tag = new self();
		$tag->id = $calibreObjectRow['id'];
		$tag->name = $calibreObjectRow['name'];
		$tag->databasePath = $databasePath;
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